<?php

namespace App\Form;

use App\Entity\Reclamation;
use Doctrine\DBAL\Types\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ReclamationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subject', ChoiceType::class,[
                'choices' => [

                    'Hotel'=> 'Hotel',
                    'Restaurant'=> 'Restaurant',
                    'Transport'=> 'Transport'

                ],
                'placeholder'=>'Choose an option'
            ])
            ->add('message',TextareaType::class,
                    array('attr' => array('cols' => '10', 'rows' => '5')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reclamation::class,
        ]);
    }
}
