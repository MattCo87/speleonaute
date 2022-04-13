<?php

namespace App\Controller\Admin;

use App\Entity\PageVisiteur;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PageVisiteurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PageVisiteur::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titre'),
            TextEditorField::new('contenu'),
        ];
    }
    
}
