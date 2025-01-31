<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Recipe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la recette : ',
                'label_attr' => [
                    'class' => 'form-label'
                ]
            ])
            ->add('description', TextType::class, [
                'attr' => [
                    'class' => 'form-label',
                    'placeholder' => 'Décrivez en quelques mots votre recette de la recette'
                ],

                'label' => 'Description : ',
                'label_attr' => [
                    'class' => 'form-label'
                ]
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'attr' => [
                    'class' => 'form-label',
                    'placeholder' => 'Choississez votre catégorie '
                ],
                'label' => 'Catégorie : ',
                'label_attr' => [
                    'class' => 'form-label'
                ]
            ])
            ->add('createdAt', null, [
                'widget' => 'single_text',
            ])
            ->add('slug')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
