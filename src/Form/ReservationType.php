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
                'label'=> 'Nom / Lastname',
                'attr' =>[
                    'placeholder' => "Votre nom / Your lastname"
                ]
            ])
            ->add('email', EmailType::class, [
                'label'=> 'Email',
                'attr' =>[
                    'placeholder' => "Votre e-mail / Your email"
                ]
            ])
            ->add('phone', TextType::class, [
                'label'=> 'Numéro de téléphone / Phone number',
                'attr' =>[
                    'placeholder' => "Votre numéro / Your phone number"
                ]
            ])
            ->add('animal', CheckboxType::class, [
                'label' => 'Cochez si vous enmener votre animal. / Check if you have animal(s).',
                'required' => false
            ])
            ->add('adults', IntegerType::class, [
                'label' => "Nombre d'adultes / Number of adults",
                'required' => true
            ])
            ->add('kids', IntegerType::class, [
                'label' => "Nombre d'enfants / Number of kids",
                'required' => true
            ])
            ->add('kidbed', CheckboxType::class, [
                'label' => 'Lit enfant requis / Baby bed required',
                'required' => false
            ])
            ->add('arrival', DateType::class, $this->getConfiguration("Date d'arrivée / Arrival date" ,"Date d'arrivée / Arrival date"))
            ->add('departure', DateType::class, $this->getConfiguration("Date de départ / Departure date" ,"Date d'arrivée / Départure date"))
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
            'data_class' => Reservation::class,
        ]);
    }
}
