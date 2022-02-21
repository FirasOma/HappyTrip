<?php

namespace App\Controller\Admin;

use App\Entity\ReservationRestaurant;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

class ReservationRestaurantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ReservationRestaurant::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $fields = [
            TextField::new('nom'),
            TextField::new('tel'),
            IntegerField::new('nombreplace'),
            DateTimeField::new('reservationdate'),
        ];
        
        return $fields;
    }
}
