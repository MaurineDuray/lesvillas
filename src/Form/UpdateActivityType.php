<?php

namespace App\Form;

use App\Entity\Activities;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class UpdateActivityType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label'=> "Titre de l'activité en français",
                'attr' =>[
                    'placeholder' => "Titre de l'activité en français"
                ]
            ])
            ->add('titreEn', TextType::class, [
                'label'=> "Titre de l'activité en anglais",
                'attr' =>[
                    'placeholder' => "Titre de l'activité en anglais"
                ]
            ])
            ->add('titreEs', TextType::class, [
                'label'=> "Titre de l'activité en espagnol",
                'attr' =>[
                    'placeholder' => "Titre de l'activité en espagnol"
                ]
            ])
            ->add('description', TextareaType::class, [
                'label'=>'Description en français',
                'required'=> false
            ])
            ->add('descriptionEn', TextareaType::class, [
                'label'=>'Description en anglais',
                'required'=> false
            ])
            ->add('descriptionEs', TextareaType::class, [
                'label'=>'Description en espagnol',
                'required'=> false
            ])
            ->add('localisation', ChoiceType::class, [
                'choices'=>[
                    "Côte d'Azur" => "Cotes d'Azur",
                    'Floride' => "Floride",
                ]
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
            'data_class' => Activities::class,
        ]);
    }
}
