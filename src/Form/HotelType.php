<?php

namespace App\Form;

use App\Entity\Hotel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
class HotelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom')
            ->add('NombreEtoile')
            ->add('options')
            ->add('Prix')
            ->add('Destination')
            ->add('Image',FileType::class,array('data_class'=> null , 'required' => false,))
            //->add('Reserver',SubmitType::class ,['label' => 'Valider'])
->getForm();
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Hotel::class,
        ]);

    }
    public static function processImage(UploadedFile $uploaded_file)
    {
        $path='../web/images/upload/images/Hotel';
        $file_name=$uploaded_file->getClientOriginalName();
        $uploaded_file->move($path ,$file_name);
        return $file_name;
    }

}
