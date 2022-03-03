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
            TextField::new('pseudo', 'Pseudo'),
            TextField::new('name', 'Nom'),
            TextField::new('firstname', 'Prénom'),
            TextField::new('role', 'Rôle ou position dans l\'équipe'),
            TextField::new('main', 'Personnage/Arme ou autre préféré'),
            AssociationField::new('equipe', 'Equipe'),
            ImageField::new('picture', 'Photo du joueur, 600px de hauteur')
                        ->setBasePath(' uploads/')
                        ->setUploadDir('public/uploads/img')
                    ->setUploadedFileNamePattern('[name][randomhash].[extension]')
                    ->setRequired(true),
        ];
    }
    
}
