<?php

namespace App\Form;

use App\Entity\Offer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class)
            ->add('description',TextareaType::class)
            ->add('image',FileType::class, array('data_class' => null, 'required' => false,))
            ->add('createdAt',DateTimeType::class)
            ->add('dateBegin',DateTimeType::class)
            ->add('DateEnd',DateTimeType::class)
            ->add('cancel',CheckboxType::class);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Offer::class,
            'csrf_pProtection' => false

        ]);
    }
    public static function processImage(UploadedFile $uploaded_file): string
    {
        $path='../uploads/images/Event';
        $file_name=$uploaded_file->getClientOriginalName();
        $uploaded_file->move($path ,$file_name);
        return $file_name;
    }
}
