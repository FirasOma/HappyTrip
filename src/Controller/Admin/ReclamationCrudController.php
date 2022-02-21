<?php

namespace App\Controller\Admin;

use App\Entity\Reclamation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;

class ReclamationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reclamation::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('subject'),
            TextEditorField::new('message'),
            AssociationField::new('user')->hideOnForm(),
            IntegerField::new('stars_number')
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->disable(Action::NEW);

    }

}
