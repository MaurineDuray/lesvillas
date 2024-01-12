<?php

namespace App\Form;

use App\Entity\Reservation;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ReservationType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label'=> 'Nom / Lastname / Nombre',
                'attr' =>[
                    'placeholder' => "Votre nom / Your lastname / Su nombre"
                ]
            ])
            ->add('email', EmailType::class, [
                'label'=> 'Email',
                'attr' =>[
                    'placeholder' => "Votre e-mail / Your email / Su email"
                ]
            ])
            ->add('phone', TextType::class, [
                'label'=> 'Numéro de téléphone / Phone number / Teléfono',
                'attr' =>[
                    'placeholder' => "Votre numéro / Your phone number / Su teléfono"
                ]
            ])
            ->add('animal', CheckboxType::class, [
                'label' => 'Cochez si vous enmener votre animal. / Check if you have animal(s). / Marque la casilla si lleva a su mascota con usted.',
                'required' => false
            ])
            ->add('nbAnimals', IntegerType::class, [
                'label' => "Nombre d'animaux / Number of animals / Número de animales",
                'required' => false
            ])
            ->add('adults', IntegerType::class, [
                'label' => "Nombre d'adultes / Number of adults / Número de adultos",
                'required' => true
            ])
            ->add('kids', IntegerType::class, [
                'label' => "Nombre d'enfants (+12 ans) / Number of kids(+12 years) / Número de niños (+12años)",
                'required' => false
            ])
            ->add('kidbed', CheckboxType::class, [
                'label' => 'Lit enfant requis / Baby bed required / Se necesita cuna',
                'required' => false
            ])
            ->add('arrival', DateType::class, [
                'label'=> "Date d'arrivée / Arrival date / Fecha de llegada ",
                'widget' => 'single_text',
               
            ])
            ->add('departure', DateType::class, [
                'label'=> "Date de départ / Departure date / Fecha de salida",
                'widget' => 'single_text',
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
            'data_class' => Reservation::class,
        ]);
    }
}
