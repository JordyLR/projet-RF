<?php

namespace App\Controller\Admin;

use App\Entity\Equipe;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EquipeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Equipe::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('game', 'Jeux'),
            ImageField::new('banner', 'Bannière, 1400px de largeur')
                        ->setBasePath(' uploads/')
                        ->setUploadDir('public/uploads/img')
                    ->setUploadedFileNamePattern('[name][randomhash].[extension]')
                    ->setRequired(true),
        ];
    }
}
