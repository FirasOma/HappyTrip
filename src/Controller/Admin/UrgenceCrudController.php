<?php

namespace App\Controller\Admin;

use App\Entity\Urgence;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

class UrgenceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Urgence::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $fields = [
            TextField::new('nom'),
            TextField::new('localisation'),
            TextField::new('type'),
        ];
        /*if ($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL) {
            $fields[] = $image;
        } else {
            $fields[] = $imageHotel;
        }*/
        return $fields;
    }
}
