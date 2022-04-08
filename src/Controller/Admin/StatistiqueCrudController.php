<?php

namespace App\Controller\Admin;

use App\Entity\Statistique;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class StatistiqueCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Statistique::class;
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
