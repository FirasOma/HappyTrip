<?php

namespace App\Form;

use App\Entity\Event;
use libphonenumber\PhoneNumberType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Console\Helper\HelperInterface;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class)
            ->add('description',TextareaType::class)
            ->add('image',FileType::class)
            ->add('createdAt',DateTimeType::class)
            ->add('phone',NumberType::class)
            ->add('address',TextType::class)
            ->add('datEvent',DateTimeType::class)
            ->add('cancel',ChoiceType::class,array([
                'choices' => [

                    'cancled' => true,
                    'Available'   => false,

                ],
                'placeholder'=>'Choose an option'
            ]))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
