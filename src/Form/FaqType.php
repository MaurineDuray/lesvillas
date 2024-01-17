<?php

namespace App\Form;

use App\Entity\Faq;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class FaqType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('question', TextareaType::class, [
                'label'=> "Question en français",
                'attr' =>[
                    'placeholder' => "Question en français"
                ]
            ])
            ->add('questionEn', TextareaType::class, [
                'label'=> "Question en anglais",
                'attr' =>[
                    'placeholder' => "Question en anglais"
                ]
            ])
            ->add('questionEs', TextareaType::class, [
                'label'=> "Question en espagnol",
                'attr' =>[
                    'placeholder' => "Question en espagnol"
                ]
            ])
            ->add('response', TextareaType::class, [
                'label'=> "Réponse en français",
                'attr' =>[
                    'placeholder' => "Réponse en français"
                ]
            ])
            ->add('responseEn', TextareaType::class, [
                'label'=> "Réponse en anglais",
                'attr' =>[
                    'placeholder' => "Réponse en anglais"
                ]
            ])
            ->add('responseEs', TextareaType::class, [
                'label'=> "Réponse en espagnol",
                'attr' =>[
                    'placeholder' => "Réponse en espagnol"
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
            'data_class' => Faq::class,
        ]);
    }
}
