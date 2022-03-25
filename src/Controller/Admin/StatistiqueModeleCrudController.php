<?php

namespace App\Controller\Admin;

use App\Entity\StatistiqueModele;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class StatistiqueModeleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return StatistiqueModele::class;
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
            IntegerField::new('valeurMin'),
            IntegerField::new('valeurMax'),
            IntegerField::new('valeurNiv'),
            AssociationField::new('lienModele'),
            AssociationField::new('lienStatistique'),
        ];
    }
}
