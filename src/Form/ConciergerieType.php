<?php

namespace App\Form;

use App\Entity\Conciergerie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ConciergerieType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label'=> 'Nom / Name',
                'attr' =>[
                    'placeholder' => "Votre nom / Your name"
                ]
            ])
            ->add('email', EmailType::class,[
                'label'=> 'Email',
                'attr' =>[
                    'placeholder' => "Votre email / Your e-mail"
                ]
            ]
            )
            ->add('phone', TextType::class, [
                'label'=> 'Numéro de téléphone / Phone number',
                'attr' =>[
                    'placeholder' => "Votre numéro téléphone / Your phone number"
                ]
            ])
            ->add('superficie', NumberType::class, [
                'label'=> 'Superficie / Surface area',
                'attr' =>[
                    'placeholder' => "Superficie du logement / Surface area of the property"
                ]
            ])
            ->add('adress', TextType::class, [
                'label'=> 'Adresse du logement / Accommodation address',
                'attr' =>[
                    'placeholder' => "Adresse du logement / Accomodation address"
                ]
            ])
            ->add('message', TextareaType::class, [
                'label'=> 'Message',
                'attr' =>[
                    'placeholder' => "Votre message / Your message"
                ]
            ])
            ->add('submit', SubmitType::class,['label' => 'Enregistrer / Register'],
            [
                'attr' => ['class' => 'btn'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Conciergerie::class,
        ]);
    }
}
