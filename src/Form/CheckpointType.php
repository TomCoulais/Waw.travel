<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\Checkpoint;

class CheckpointType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('spotName', TextType::class, [
                'label' => 'Nom du spot',
            ])
            ->add('longitude', NumberType::class, [
                'label' => 'Longitude',
                'attr' => ['step' => 'any'],
            ])
            ->add('latitude', NumberType::class, [
                'label' => 'Latitude',
                'attr' => ['step' => 'any'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Checkpoint::class,
        ]);
    }
}
