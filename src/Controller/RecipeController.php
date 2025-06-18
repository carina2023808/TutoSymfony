<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeType;
use App\Repository\RecipeRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Dom\Entity;
use PHPUnit\Util\Json;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class RecipeController extends AbstractController
{
    #[Route(path: "/recette", name: "app_recipe_index")]
    
    public function index(Request $request, RecipeRepository $repository, EntityManagerInterface $em): Response
    {
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
        $recipes = $repository->findAll();
        //  $recipes = $repository->findRecipeDurationLowerThan(20);  /*esse e a chamada do methode*/
        // dump($recipes);



        // modificar o titro da receita
        // o numero 3 e o index  da receita nao o id  que eu quero alterar
        // $recipes[3]->setTitle("Omelette "); 
        // $em->flush();

        //supressao de uma receita
        // $em->remove($recipes[3]);
        // $em->flush();


        //comment récuperer nos recettes sans appeler le RecipeRepository
        // $recipes = $em->getRepository(Recipe::class)->findAll();

        //exo 12
        // $recipe = new Recipe(); /*instanciar a classe Recipe*/
        // $recipe->setTitle("Tartelettes au riz")
        //     ->setSlug("tartelettes-au-riz")
        //     ->setContent("Préchauffez le four à 180 °C.

        //                  Battez les œufs avec le sucre. Ajoutez la farine et le riz au lait, et mélangez.

        //                 Déroulez la pâte brisée et coupez-la en 4, ainsi que la feuille de papier cuisson, et disposez-les dans des moules à tartelette et répartissez le mélange au riz au lait dans les moules et glissez 30 min au four préchauffé.

        //                 Sortez les tartelettes du four et laissez-les refroidir.

        //                 Garnissez les tartelettes de pâte à tartiner Amande-pistache, de framboises et de pistaches.'")
        // ->setDuration(60)
        // ->setCreatedAt(new DateTimeImmutable())
        // ->setUpdatedAt(new DateTimeImmutable());
        // $em->persist($recipe); /*persistir a receita*/
        // $em->flush(); /*gravar a receita no banco de dados*/

        // $recipe = new Recipe(); /*instanciar a classe Recipe*/
        // $recipe->setTitle("Braisade de saumon")
        //     ->setSlug("omelette")
        //     ->setContent("1-Lavez soigneusement les grenailles non pelées sous l’eau froide. Faites-les cuire 20 min dans de l’eau bouillante légèrement salée. Égouttez-les et passez-les sous l’eau froide. Égouttez-les et coupez-les en 2.

        //                 2-Entre-temps, coupez les extrémités des haricots. Faites cuire ces derniers dans de l’eau bouillante légèrement salée 6 à 7 min. Égouttez-les et passez-les sous l’eau froide pour conserver leur belle couleur verte.

        //                 3-Détaillez l’oignon rouge et les concombres en fines rondelles. Mélangez le tout avec la roquette, les haricots verts et les grenailles.

        //                 4-Ciselez l’aneth. Mélangez-en la moitié avec à la crème, la moutarde et le miel. Salez et poivrez.

        //                 5-Préparation au barbecue (20 min)
        //                 6-Faites cuire les braisades de saumon et les broccolinis 3 à 4 min de chaque côté sur un barbecue à feu modéré.

        //                 7-Servez les braisades de saumon avec la salade de grenailles et les broccolinis. Garnissez avec les amandes effilées grillées et du reste de l’aneth. Servez le dressing à part.'")
        //     ->setDuration(25)
        //     ->setCreatedAt(new DateTimeImmutable())
        //     ->setUpdatedAt(new DateTimeImmutable());
        //    $em->persist($recipe); /*persistir a receita*/
        //    $em->flush(); /*gravar a receita no banco de dados*/

        // $recipes[4]->setTitle(" Taboulé au lard")
        //     ->setSlug("taboule-au-lard")
        //     ->setContent(" 1-Faites cuire le boulgour dans de l’eau bouillante légèrement salée (voir temps de cuisson sur l’emballage). Égouttez, ajoutez les mendiants et laissez refroidir.

        //                 2-Entre-temps, coupez le poivron pointu en 2 dans le sens de la longueur et retirez les graines et les filaments blancs. Détaillez le reste, ainsi que la feta, en dés. Effeuillez les branches de thym et ciselez les feuilles.

        //                 3-Épluchez les asperges de la tête vers le pied et coupez l’extrémité dure.

        //                 4-Disposez le boulgour froid dans un grand bol et intégrez-y délicatement le poivron pointu et quelques feuilles de thym.

        //                 5-Extrayez la chair des fruits de la passion et mélangez-la avec le miel, le thym et 2/3 de l’huile d’olive. Salez et poivrez.


        //                 6-Badigeonnez les asperges blanches avec le reste de l’huile d’olive. Parsemez de poivre et d’un peu de thym. Faites-les griller 5 à 6 min sur un barbecue à feu modéré. Retournez-les régulièrement.

        //                 7-Faites griller les tranches de lard 3 à 4 min de chaque côté sur le barbecue.

        //                 8-Coupez le lard en lanières d’1 cm et les asperges grillées en 2, de biais. Répartissez le taboulé dans les assiettes et disposez les asperges grillées, les dés de feta et le lard par-dessus. Garnissez de dressing au fruit de la passion et de thym restant.")
        //     ->setDuration(30)
        //     ->setCreatedAt(new DateTimeImmutable())
        //     ->setUpdatedAt(new DateTimeImmutable());
        // $em->flush();


        //exo14
        //   $em->remove($recipes[4]);
        //        $em->flush();



        // $recipes[5]->setSlug("braisade-de-saumon");
        //  $em->flush();

        return $this->render('recipe/index.html.twig', [
            'recipes' => $recipes
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
    public function edit(Recipe $recipe, Request $request, EntityManagerInterface $em): Response{
        // dd($recipe);
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);
        // dd($recipe);
        if ($form->isSubmitted()&& $form->isValid()){
                  $recipe->setUpdatedAt(new DateTimeImmutable());
            $em->flush();
            $this->addFlash('success', ' La Recette a bien été modifiée !');// mensagem de sucesso
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
#[Route(path :'/recette/create', name :'app_recipe_create')]
public function creat (Request $request , EntityManagerInterface $em): Response {
    $recipe = new Recipe;
    $form = $this->createForm(RecipeType::class, $recipe);
    $form->handleRequest($request);
    if ($form->isSubmitted()&& $form->isValid()){//verifica se o formulario foi submetido e se e valido 
        //respeitando as regras do RecipeType dentro de $builder
        
        $recipe->setCreatedAt(new DateTimeImmutable())
                ->setUpdatedAt(new DateTimeImmutable());
     $em->persist($recipe);
     $em->flush();
     $this->addFlash('success', ' La Recettte'.$recipe->getTitle(). ' a bien été crée !');
    return $this->redirectToRoute('app_recipe_index');
    }
    return $this->render('recipe/create.html.twig', [
    'monForm'=>$form
    ]);
}
#[Route(path: '/recette/{id}/delete', name: 'app_recipe_delete')]
public function delete(Recipe $recipe, EntityManagerInterface $em): Response{
   $titre =$recipe->getTitle();
    $em->remove($recipe);
    $em->flush();
    $this->addFlash('info', ' La Recette '.$titre(). ' a bien été supprimée !');
    return $this->redirectToRoute('app_recipe_index');
}




}
   

