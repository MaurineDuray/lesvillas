<?php

namespace App\Form;


use App\Entity\Contact;
use App\Form\ApplicationType;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ContactType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label'=> 'Nom / Lastname / Su nombre',
                'attr' =>[
                    'placeholder' => "Votre nom / Your lastname / Su Nombre"
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
            'data_class' => Contact::class,
        ]);
    }
}
