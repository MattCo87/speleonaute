<?php

namespace App\Controller\Admin;

use App\Entity\ActionStrategie;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

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
}
