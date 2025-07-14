<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeType;
use App\Form\SearchType;
use App\Model\SearchData;
use App\Repository\RecipeRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Dom\Entity;
use Knp\Component\Pager\PaginatorInterface;
use PHPUnit\Util\Json;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

final class RecipeController extends AbstractController
{
    #[Route(path: "/recette", name: "app_recipe_index")]

    public function index(
        Request $request,
        RecipeRepository $repository,
        EntityManagerInterface $em,
        TranslatorInterface $translator,
        PaginatorInterface $paginatorInterface
    ): Response {
        $searchData = new SearchData();
        $form = $this->createForm(SearchType::class, $searchData);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // dd($searchData);
        }

        if ($this->getUser()) {
            /** 
             *@var User
             */
            $user = $this->getUser();
            if (!$user->isVerified()) {
                $this->addFlash('info', $translator->trans('recipeContoller.emailNotVerified'));
            }
        }
        // return new Response("Bienvenue sur la page des recettes");

        /* creation de um reccete gravando no banco de dados*/
        //     $recipe = new Recipe(); /*instanciar a classe Recipe*/
        //     $recipe->setTitle("Omelette")
        //    ->setSlug("omelette")
        //    ->setContent("Prenez des oeufs, cassez les et ensuite battez les en rajoutant du sel.'")
        //    ->setDuration(6)
        //    ->setCreatedAt(new DateTimeImmutable())
        //    ->setUpdatedAt(new DateTimeImmutable());
        //    $em->persist($recipe); /*persistir a receita*/
        //    $em->flush(); /*gravar a receita no banco de dados*/

        // return new Response("Bienvenue sur la page des recettes");
        $data = $repository->findAll();
        $recipeTotal = sizeof($data);
        $recipes = $paginatorInterface->paginate(
            $data,
            $request->query->getInt('page', 1),
            6
        );
  // barra de recherch 
        $searchData = new SearchData();
        $form = $this->createForm(SearchType::class, $searchData);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $searchData->page = $request->query->getInt('page', 1);
        
            $recipes = $repository->findBySeach($searchData);
            $recipeTotal = sizeof($recipes);

            return $this->render('recipe/index.html.twig', [
                'form' => $form,
                'recipes' => $recipes,
                'recipeTotal'=>$recipeTotal,
               ]);
        }

        return $this->render('recipe/index.html.twig', [
            'form' => $form->createView(),
            'recipes' => $recipes,
            'recipeTotal' => $recipeTotal,


        ]);
    }
    //slug(un caractere) eo o que vai aparecer na url
    //id eo o que vai aparecer na pagina par default caso o 1° nao seja passado
    //o 1° receita eo que vai aparecer na url o 2° receita eo que vai aparecer na pagina par default caso o 1° nao seja passado
    #[Route('/recette/{slug}-{id}', name: 'app_recipe_show', requirements: ['id' => '\d+', 'slug' => '[a-z0-9-]+'])]

    public function show(Request $request, string $slug, int $id, RecipeRepository $repositoy): Response
    {

        // dd($request->attributes->get("id"),$request->attributes->getInt("slug") );
        // dd ($slug,$id);
        // dd($request); 
        // o 1° recette  eo que vai escrever  na url o 2° receita eo que vai aparecer na pagina par default caso o 1° nao seja passado
        // return new Response("Bienvenue sur la page ". $request->query->get("recette", "des recettes"));
        // return new Response("Recette numéro  ".$id. " : ".$slug); 


        $recipe = $repositoy->find($id);
        // dump($recipe);
        if ($recipe->getSlug() !== $slug) {
            return $this->redirectToRoute('app_recipe_show', [
                'slug' => $recipe->getSlug(),
                'id' => $recipe->getId(),

            ]);
        }
        return $this->render('recipe/show.html.twig', [
            // 'slug' => $slug,
            // 'id' => $id,
            'recipe' => $recipe //recipe eo o que vai aparecer na pagina par default caso o 1° nao seja passado

            // 'user' => [
            //     'firstname' => 'Carina',
            //     'lastname' => 'JC',
            // ]

            // 'user' => $recipe->getUser()    

        ]);

        // return new JsonResponse([
        //     'id' => $id,
        //     'slug' => $slug

        // ]);
        // return json sem importar maneira mais simples
        // return $this->json([
        //     'id' => $id,
        //     'slug' => $slug
        // ]);


    }



    #[Route(path: "/recette/{id}/edit", name: "app_recipe_edit")]

    public function edit(Recipe $recipe, Request $request, EntityManagerInterface $em, TranslatorInterface $translator): Response
    {
        if ($this->getUser()) {
            /**
             * @var User
             */
            $user = $this->getUser();
            if (!$user->isVerified()) {
                $this->addFlash('info', $translator->trans('recipeContoller.edit.confirmEmail'));
                return $this->redirectToRoute('app_recipe_index');
            }
            if ($user->getEmail() !== $recipe->getUser()->getEmail()) {
                $this->addFlash("error", $translator->trans("recipeController.edit.userRecipe1") . $recipe->getUser()->getEmail() . $translator->trans("recipeController.edit.userRecipe2"));
                return $this->redirectToRoute('app_recipe_index');
            }
        } else {
            $this->addFlash("error", $translator->trans("recipeController.edit.mustLogin"));
            return $this->redirectToRoute("app_login");
        }

        // dd($recipe); 
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);
        // dd($recipe);
        if ($form->isSubmitted() && $form->isValid()) {
            $recipe->setUpdatedAt(new DateTimeImmutable());
            $em->flush();
            $this->addFlash('success', $translator->trans('recipeController.edit.success')); // mensagem de sucesso
            // $this->addFlash('error', ' La Recette a bien été modifiée !');// mensagem de erro
            //  return $this->redirectToRoute('app_recipe_show'); // redirecionar para a pagina index
            return $this->redirectToRoute('app_recipe_show', [
                'slug' => $recipe->getSlug(),
                'id' => $recipe->getId()
            ]);
        }
        return $this->render('recipe/edit.html.twig', [
            'recipe' => $recipe,
            'monForm' => $form
        ]);
    }
    #[Route(path: '/recette/create', name: 'app_recipe_create')]
    public function creat(Request $request, EntityManagerInterface $em, TranslatorInterface $translator): Response
    {
        if ($this->getUser()) {
            /** 
             *@var User
             */
            $user = $this->getUser();
            if (!$user->isVerified()) {
                $this->addFlash('error', $translator->trans('recipeContoller.create.confirmEmail'));
                return $this->redirectToRoute('app_recipe_index');
            }
        } else {
            $this->addFlash('error', $translator->trans('recipeContoller.create.mustLogin'));
            return $this->redirectToRoute('app_login');
        }


        $recipe = new Recipe;
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) { //verifica se o formulario foi submetido e se e valido 
            //respeitando as regras do RecipeType dentro de $builder

            $recipe->setUser($this->getUser())
                ->setCreatedAt(new DateTimeImmutable())
                ->setUpdatedAt(new DateTimeImmutable());
            $em->persist($recipe);
            $em->flush();
            $this->addFlash('success', $translator->trans('recipeContoller.success.createRecipe1') . ' ' . $recipe->getTitle() . $translator->trans('recipeContoller.success.createRecipe2'));
            return $this->redirectToRoute('app_recipe_index');
        }
        return $this->render('recipe/create.html.twig', [
            'monForm' => $form
        ]);
    }
    #[Route(path: '/recette/{id}/delete', name: 'app_recipe_delete')]
    public function delete(Recipe $recipe, EntityManagerInterface $em): Response
    {
        if ($this->getUser()) {
            /**
             * @var User
             */
            $user = $this->getUser();
            if (!$user->isVerified()) {
                $this->addFlash("error", "You must confirm your email to edit a Recipe !");
                return $this->redirectToRoute('app_recipe_index');
            }
            if ($user->getEmail() !== $recipe->getUser()->getEmail()) {
                $this->addFlash("error", "You must to be " . $recipe->getUser()->getEmail() . " to delete this Recipe !");
                return $this->redirectToRoute('app_recipe_index');
            }
        } else {
            $this->addFlash("error", "You must login to edit a Recipe !");
            return $this->redirectToRoute("app_login");
        }
        $titre = $recipe->getTitle();
        $em->remove($recipe);
        $em->flush();
        $this->addFlash('info', ' La Recette ' . $titre() . ' a bien été supprimée !');
        return $this->redirectToRoute('app_recipe_index');
    }
}
