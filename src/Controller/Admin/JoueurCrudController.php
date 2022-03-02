<?php

namespace App\Controller\Admin;

use App\Entity\Joueur;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class JoueurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Joueur::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextField::new('firstname'),
            TextField::new('role'),
            TextField::new('main'),
            AssociationField::new('equipe'),
            ImageField::new('picture')
                        ->setBasePath(' uploads/')
                        ->setUploadDir('public/uploads/img')
                    ->setUploadedFileNamePattern('[name][randomhash].[extension]')
                    ->setRequired(true),
        ];
    }
    
}
