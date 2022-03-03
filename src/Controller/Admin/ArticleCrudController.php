<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title', 'Titre'),
            TextField::new('resume', 'Résumé'),
            TextEditorField::new('content', 'Contenu'),
            AssociationField::new('equipe', 'Equipe'),
            ImageField::new('image', 'Image de 500ko maximum')
                        ->setBasePath(' uploads/')
                        ->setUploadDir('public/uploads/img')
                    ->setUploadedFileNamePattern('[name][randomhash].[extension]')
                    ->setRequired(true),
        ];
    }
}
