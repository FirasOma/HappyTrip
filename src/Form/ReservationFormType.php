<?php

namespace App\Form;

use App\Entity\Reservation;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startDate',DateType::class,[
            'widget' => 'single_text'


            ])
            ->add('endDate',DateType::class,[
                'widget' => 'single_text'
            ])
            ->add('numberOfNights',IntegerType::class,
                [
                    'attr'=> [
                        'min'=>1,
                        'max'=>15,
                        'required'=>true
                    ]
                ])
            ->add('numberOfrooms',IntegerType::class,
            [
                'attr'=> [
                    'min'=>1,
                    'max'=>5,
                    'required'=>true
                ]
            ])
            ->add('numberOfAdults',IntegerType::class,[
                'attr'=> [
                    'min'=>0,
                    'max'=>4,
                    'required'=>true
                ]
            ])
            ->add('numberOfChilds',IntegerType::class,[
                'attr'=> [
                    'min'=>0,
                    'max'=>3,
                    'required'=>true
                ]
            ])
            ->add('roomType',ChoiceType::class,[
                'choices' => [

                    'half pension'=> 'half pension',
                    'full pension'=> 'full pension',
                    'All Inclusive'=> 'All Inclusive',
                    'All inclusive Soft Drink' => 'All inclusive Soft Drink'

                ],
                'placeholder'=>'choose an option'
            ])
            ->add('Book',SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
