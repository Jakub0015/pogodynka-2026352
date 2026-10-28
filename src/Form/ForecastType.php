<?php

namespace App\Form;

use App\Entity\Forecast;
use App\Entity\Location;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ForecastType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('location', EntityType::class, [
                'class' => Location::class,
                'choice_label' => fn (Location $location) => $location->getName() . ' (' . $location->getCountry() . ')',
                'placeholder' => 'Choose location',
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('temperature', null, [
                'label' => 'Temperature (°C)',
            ])
            ->add('humidity', null, [
                'label' => 'Humidity (%)',
            ])
            ->add('precipitation', null, [
                'label' => 'Precipitation (mm)',
            ])
            ->add('wind', null, [
                'label' => 'Wind (km/h)',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Forecast::class,
        ]);
    }
}
