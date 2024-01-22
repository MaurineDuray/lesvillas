<?php

namespace App\Form;

use App\Entity\Blog;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class BlogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titleFr', TextType::class, [
                'label'=> 'Titre en français',
                'attr' =>[
                    'placeholder' => "Titre en français"
                ]
            ])
            ->add('titleEn', TextType::class, [
                'label'=> 'Titre en anglais',
                'attr' =>[
                    'placeholder' => "Titre en anglais"
                ]
            ])
            ->add('titleEs', TextType::class, [
                'label'=> 'Titre en espagnol',
                'attr' =>[
                    'placeholder' => "Titre en espagnol"
                ]
            ])
            // ->add('textFr', CKEditorType::class, [
            //     'label'=> "Contenu en français",
            //     'attr' =>[
            //         'placeholder' => "Contenu en français"
            //     ]
            // ])
            ->add('textFr', TextareaType::class, [
                'label'=> "Contenu en français",
                'attr' =>[
                    'placeholder' => "Contenu en français"
                ]
            ])
            // ->add('textEn', CKEditorType::class, [
            //     'label'=> "Contenu en anglais",
            //     'attr' =>[
            //         'placeholder' => "Contenu en anglais"
            //     ]
            // ])
            ->add('textEn', TextareaType::class, [
                'label'=> "Contenu en anglais",
                'attr' =>[
                    'placeholder' => "Contenu en anglais"
                ]
            ])
            // ->add('textEs', CKEditorType::class, [
            //     'label'=> "Contenu en Espagnol",
            //     'attr' =>[
            //         'placeholder' => "Contenu en Espagnol"
            //     ]
            // ])
            ->add('textEs', TextareaType::class, [
                'label'=> "Contenu en espagnol",
                'attr' =>[
                    'placeholder' => "Contenu en espagnol"
                ]
            ])
            ->add('image', FileType::class, [
                "required"=>false,
                "data_class"=>null,
                "label"=>"Image de couverture du logement"
            ])
            ->add('submit', SubmitType::class,['label' => 'Enregistrer'],
            [
                'attr' => ['class' => 'btn'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Blog::class,
        ]);
    }
}
