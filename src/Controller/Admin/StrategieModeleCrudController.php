<?php

namespace App\Controller\Admin;

use App\Entity\StrategieModele;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class StrategieModeleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return StrategieModele::class;
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
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            IntegerField::new('positionStrategie'),
            AssociationField::new('lienModele'),
            AssociationField::new('lienStrategie'),
        ];
    }
}
