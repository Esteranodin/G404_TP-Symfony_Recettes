<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Recipe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\Form\Event\PreSubmitEvent;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\Validator\Constraints\DateTime;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label_attr' => [
                    'class' => 'form-label'
                ]
            ])

            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'form-label',
                    'placeholder' => 'Décrivez en quelques mots votre recette'
                ],
                'label_attr' => [
                    'class' => 'form-label'
                ]
            ])

            ->add('category', EntityType::class, [
                'class' => Category::class,
                'attr' => [
                    'class' => 'form-input',
                ],
                'label_attr' => [
                    'class' => 'form-label'
                ]
            ])

            // ->add('createdAt', DateType::class, [
            //     'label' => "Date d'ajout",
            //     'input'  => 'datetime_immutable',
            //     'attr' => [
            //         'class' => 'form-input',
            //     ],
            //     'label_attr' => [
            //         'class' => 'form-label'
            //     ]
            // ])

            ->add('slug', null, [
                'required' => false,
                'label_attr' => [
                    'class' => 'form-label',
                ]
            ])

            ->addEventListener(FormEvents::PRE_SUBMIT, $this->autoSlug(...))

            ->addEventListener(FormEvents::POST_SUBMIT, $this->createdAt(...))

        ;
    }


    public function autoSlug(PreSubmitEvent $event): void
    {
        $data = $event->getData();

        if (empty($data['slug'])) {
            $slugger = new AsciiSlugger();
            $data['slug'] = strtolower($slugger->slug($data['name']));
            $event->setData($data);
        }
    }


    public function createdAt(PostSubmitEvent $event): void
    {
        $data = $event->getData();

        if (!($data instanceof Recipe)) {
            return;
        } elseif (!$data->getId()) {
            $data->setCreatedAt(new \DateTimeImmutable());
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
