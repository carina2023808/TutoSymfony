<?php
// src/Form/SearchType.php

namespace App\Form;

use App\Entity\User;
use App\Model\SearchData;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, ['required' => false])
            ->add('slug', TextType::class, ['required' => false])
            ->add('content', TextType::class, ['required' => false])
            ->add('duration', IntegerType::class, ['required' => false])
            ->add('imageName', TextType::class, ['required' => false])
            ->add('imageSize', IntegerType::class, ['required' => false])
            ->add('createdAt', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('updatedAt', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }
}
