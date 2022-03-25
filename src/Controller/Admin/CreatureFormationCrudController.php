<?php

namespace App\Controller\Admin;

use App\Entity\CreatureFormation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

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
}
