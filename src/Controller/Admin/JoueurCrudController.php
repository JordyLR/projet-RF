<?php

namespace App\Controller\Admin;

use App\Entity\Joueur;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

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
            TextField::new('imageFile', 'Photo du Joueur (entre 500 et 700px de hauteur, 1mo max)')->setFormType(VichImageType::class, ['required' => true])->hideOnIndex(),
            ImageField::new('picture')
                        ->setBasePath('uploads/img')->onlyOnIndex(),
        ];
    }
    
}
