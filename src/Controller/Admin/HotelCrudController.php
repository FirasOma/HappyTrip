<?php

namespace App\Controller\Admin;

use App\Entity\Hotel;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

class HotelCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Hotel::class;
    }


    public function configureFields(string $pageName): iterable
    {
      $image=ImageField::new('image')->setBasePath('/uploads');
      $imageHotel=Field::new('imageHotel')->setFormType(VichImageType::class);
        $fields = [
            TextField::new('name'),
            TextEditorField::new('description'),
            TextField::new('localisation'),
            IntegerField::new('stars_number'),
            TextField::new('adresse'),
            IntegerField::new('available_rooms')
        ];
        if ($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL) {
            $fields[] = $image;
        } else {
            $fields[] = $imageHotel;
        }


        /*if ($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL) {
            $fields[] = $image;
        } else {
            $fields[] = $imageHotel;
        }*/
        return $fields;
    }
}
