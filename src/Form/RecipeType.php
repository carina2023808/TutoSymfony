<?php

namespace App\Form;

use App\Entity\Recipe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Event\PreSubmitEvent;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\Validator\Constraints\Length;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;





class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'recipeForm.title',
                //  'constraints'  =>new Length(min:10, minMessage: 'Le titre doit comporter au moins 10 caractères.'),    

            ])
            ->add('slug',HiddenType::class)
            ->add('content', TextareaType::class,[
                'label' => 'recipeForm.content',
            ])
            // ->add('imageName', TextType::class,[
            //     'label' => 'recipeForm.imageName',
            // ])
            ->add('duration', NumberType::class,[
                'label' => 'recipeForm.duration',
            ])
            ->add('save', SubmitType::class,[
                'label' => 'recipeForm.save',
                
            ])
            ->add('imageFile', VichImageType::class, [
             'required' => false,
            'allow_delete' => true,
            'delete_label' => 'Delete recipe image',
            'download_uri' => true,
            'image_uri' => true,
            'asset_helper' => true,
            'imagine_pattern' => 'avatar_thumbnail'
])
            
             
         ->addEventListener(FormEvents::PRE_SUBMIT, $this->autoSlug(...))
         ;
                 
    }
    public function autoSlug(PreSubmitEvent $event): void{
        $data = $event->getData();
        $slugger = new AsciiSlugger();
        if(empty($data['slug']) || $data['slug'] != strtolower($slugger->slug($data['title']))){
            $data['slug'] = strtolower($slugger->slug($data['title']));
            $event->setData($data);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
