<?php

namespace App\Form;

use App\Entity\RoadTrip;    
use App\Entity\Vehicle;    
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;

class RoadTripType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
            ])
            ->add('vehicle', EntityType::class, [
                'class' => Vehicle::class,
                'choice_label' => 'type', 
                'label' => 'Choisir un véhicule',
            ])
            ->add('startDate', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de début',
                'required' => true,
            ])
            ->add('endDate', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de fin',
                'required' => true,
            ])
            ->add('coverImage', FileType::class, [
                'label' => 'Choisir une image (JPG ou PNG)', 
                'mapped' => false, 
                'required' => false, 
                'constraints' => [
                    new File([
                        'maxSize' => '2M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Veuillez télécharger une image valide (JPG ou PNG)',
                    ]),
                ],
            ])
            ->add('isCommunity', CheckboxType::class, [ 
                'label' => 'Partage public', 
                'required' => false,
                'help' => 'Cochez cette case pour partager votre road trip publiquement.', 
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Soumettre',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RoadTrip::class, 
        ]);
    }
}

