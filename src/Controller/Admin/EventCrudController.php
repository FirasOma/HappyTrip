<?php

namespace App\Controller\Admin;

use App\Entity\Event;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class EventCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Event::class;
    }
public function configureFields(string $pageName): iterable
{
    $image=ImageField::new('image')->setBasePath('/uploads');
    $imgEvent=Field::new('imageEvent')->setFormType(VichImageType::class);
    $fields=[
        TextField::new('name'),
        TextEditorField::new('description'),
        DateTimeField::new('created_at'),
        DateTimeField::new('dat_event'),
        NumberField::new('phone'),
        TextField::new('address'),
        BooleanField::new('cancel')
    ];
      if($pageName== Crud::PAGE_INDEX || $pageName== Crud::PAGE_DETAIL)
      {
          $fields[] =$image;
      }else{
          $fields[]=$imgEvent;
      }

    return $fields;
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
