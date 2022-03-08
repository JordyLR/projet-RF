<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

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
            TextField::new('imageFile')->setFormType(VichImageType::class, ['allow_delete' => false]),
            ImageField::new('image')
                        ->setBasePath(' uploads/img')->onlyOnIndex(),
        ];
    }
}
