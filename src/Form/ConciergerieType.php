<?php

namespace App\Form;

use App\Entity\Conciergerie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
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
                'label'=> 'Nom / Name / Nombre',
                'attr' =>[
                    'placeholder' => "Votre nom / Your name / Su nombre"
                ]
            ])
            ->add('email', EmailType::class,[
                'label'=> 'Email',
                'attr' =>[
                    'placeholder' => "Votre email / Your e-mail / Su email"
                ]
            ]
            )
            ->add('phone', TextType::class, [
                'label'=> 'Numéro de téléphone / Phone number / Teléfono',
                'attr' =>[
                    'placeholder' => "Votre numéro téléphone / Your phone number / Su teléfono"
                ]
            ])
            ->add('superficie', IntegerType::class, [
                'label'=> 'Superficie / Surface area / Área',
                'attr' =>[
                    'placeholder' => "Superficie du logement / Surface area of the property / Superficie del alojamiento"
                ]
            ])
            ->add('adress', TextType::class, [
                'label'=> 'Adresse du logement / Accommodation address / Dirección postal',
                'attr' =>[
                    'placeholder' => "Adresse du logement / Accomodation address / Dirección postal"
                ]
            ])
            ->add('message', TextareaType::class, [
                'label'=> 'Message / Mensaje',
                'attr' =>[
                    'placeholder' => "Votre message / Your message / Su mensaje"
                ]
            ])
            ->add('submit', SubmitType::class,['label' => 'Enregistrer / Register / Registro'],
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
