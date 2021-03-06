<?php

namespace App\Controller\Admin;

use App\Entity\Commentaire;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CommentaireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commentaire::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('content', 'Commentaire'),
            TextField::new('author.getUserIdentifier', 'Commentaire')->onlyOnIndex(),
        ];
    }
    
    public function configureActions(Actions $actions): Actions
    {
        return $actions 
            ->disable(Action::NEW, Action::EDIT);
    }

}
