<?php

namespace App\Form;

use App\Entity\Immos;
use App\Form\ApplicationType;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ImmosType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
            ->add('Titre', TextType::class, [
                'label'=> 'Titre en français',
                'attr' =>[
                    'placeholder' => "Titre du logement"
                ]
            ])
            ->add('TitreEn', TextType::class, [
                'label'=> 'Titre en anglais',
                'attr' =>[
                    'placeholder' => "Titre du logement en anglais"
                ]
            ])
            ->add('address', TextType::class, [
                'label'=> 'Adresse du logement',
                'attr' =>[
                    'placeholder' => "Adresse du logement"
                ]
            ])
            ->add('travellers', IntegerType::class, [
                'label'=> 'Nombre de voyageurs',
                'attr' =>[
                    'placeholder' => "Nombre de voyageurs"
                ]
            ])
            ->add('bedrooms', IntegerType::class, [
                'label'=> 'Nombre de chambres',
                'attr' =>[
                    'placeholder' => "Nombre de chambres"
                ]
            ])
            ->add('bathrooms',IntegerType::class, [
                'label'=> 'Nombre de salles de bain',
                'attr' =>[
                    'placeholder' => "Nombre de salles de bain"
                ]
            ])
            ->add('price', IntegerType::class, [
                'label'=> 'Prix de la chambre en euro / nuit'
            ])
            ->add('priceEn', IntegerType::class, [
                'label'=> 'Prix de la chambre en dollars / nuit'
            ])
            ->add('description', TextareaType::class, [
                'label'=>'Description en français'
            ])
            ->add('descriptionEn', TextareaType::class,[
                'label'=>'Description en anglais'
            ])
            ->add('logement', TextareaType::class, [
                'label'=>'Composition du logement en français (liste à puces)'
            ])
            ->add('logementEn',TextareaType::class,[
                'label'=>'Composition du logement en anglais (liste à puces)'
            ])
            ->add('equipement',TextareaType::class,[
                'label'=>'Equipement du logement en français (liste à puces)'
            ])
            ->add('equipementEn',TextareaType::class,[
                'label'=>'Equipement du logement en anglais (liste à puces)'
            ])
            ->add('conciergerie', ChoiceType::class, [
                'choices'=>[
                    "Côte d'Azur" => "Azur",
                    'Floride' => "Floride",
                ]
            ])
            ->add('calendrier', TextType::class,[
                'label'=>'Lien de calendrier Google',
                'required' => false
            ])
            ->add('cover', FileType::class, [
                "data_class"=>null,
                "label"=>"Image de couverture du logement"
            ])
            ->add('type',ChoiceType::class, [
                'choices'=>[
                    'Villa' => "Villa",
                    'Appartement' => "Appartement",
                    'Maison'=>"Maison",
                    'Autres'=>"Autres"
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
            'data_class' => Immos::class,
        ]);
    }
}
