<?php

namespace App\Controller\Admin;

use App\Entity\Destination;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DestinationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Destination::class;
    }

/*
    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('NomDes'),
            TextEditorField::new('SitesTouristiques'),
        ];
    }
*/
}
