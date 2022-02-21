<?php

namespace App\Form;

use App\Entity\DestinationSearch;
use Doctrine\DBAL\Types\StringType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Guess\TypeGuess;
use Symfony\Component\Form\Util\StringUtil;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DestinationSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextareaType::class,[
                'required' =>false,
                'label' =>false,
                'attr'=>[
                    'placeholder' => 'Nom'
                ]
            ])
            ->add('maxPopulation', IntegerType::class,[
                'required' =>false,
                'label' =>false,
                'attr'=>[
                    'placeholder' => 'Population maximale'
                ]
            ])
            ->add('minSurface', IntegerType::class,[
                'required' =>false,
                'label' =>false,
                'attr'=>[
                    'placeholder' => 'Surface minimale'
                ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DestinationSearch::class,
            'method' =>'get',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
