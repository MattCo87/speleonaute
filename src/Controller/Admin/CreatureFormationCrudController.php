<?php

namespace App\Controller\Admin;

use App\Entity\CreatureFormation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class CreatureFormationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CreatureFormation::class;
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
            IntegerField::new('localisation'),
            IntegerField::new('strategie'),
            AssociationField::new('lienCreature'),
            AssociationField::new('lienFormation'),
        ];
    }
}
