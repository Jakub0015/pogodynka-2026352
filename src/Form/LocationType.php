<?php

namespace App\Form;

use App\Entity\Location;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => ['placeholder' => 'Enter city name'],
            ])
            ->add('country', ChoiceType::class, [
                'placeholder' => 'Choose country',
                'choices' => [
                    'Poland' => 'PL',
                    'Germany' => 'DE',
                    'Italy' => 'IT',
                    'Spain' => 'ES',
                    'United States' => 'US',
                ],
            ])
            ->add('latitude', NumberType::class, [
                'scale' => 7,
                'input' => 'string',
            ])
            ->add('longitude', NumberType::class, [
                'scale' => 7,
                'input' => 'string',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}
