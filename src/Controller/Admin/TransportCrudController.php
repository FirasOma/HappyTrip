<?php

namespace App\Controller\Admin;

use App\Entity\Transport;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

class TransportCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Transport::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $fields = [
            TextField::new('type'),
            TextField::new('localisation'),
            TextField::new('prix'),
        ];
        /*if ($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL) {
            $fields[] = $image;
        } else {
            $fields[] = $imageHotel;
        }*/
        return $fields;
    }
}
