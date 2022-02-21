<?php

namespace App\Form;

use App\Entity\Destination;
use phpDocumentor\Reflection\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DestinationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('NomDes')
            ->add('inforDes')
            ->add('population')
            ->add('sitesTouristiques')
            ->add('transport')
            ->add('meteo')
            ->add('heureLocale')
            ->add('siteWeb')
            ->add('superficie')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Destination::class,
        ]);
    }
}
