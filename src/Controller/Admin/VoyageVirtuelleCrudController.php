<?php

namespace App\Controller\Admin;

use App\Entity\VoyageVirtuelle;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class VoyageVirtuelleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return VoyageVirtuelle::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
