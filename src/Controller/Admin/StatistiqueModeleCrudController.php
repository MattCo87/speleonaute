<?php

namespace App\Controller\Admin;

use App\Entity\StatistiqueModele;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

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
}
