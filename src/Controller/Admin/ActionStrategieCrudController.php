<?php

namespace App\Controller\Admin;

use App\Entity\ActionStrategie;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class ActionStrategieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ActionStrategie::class;
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
            IntegerField::new('positionAction'),
            AssociationField::new('lienAction'),
            AssociationField::new('lienStrategie'),
        ];
    }
}
