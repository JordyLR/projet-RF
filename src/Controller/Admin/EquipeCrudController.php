<?php

namespace App\Controller\Admin;

use App\Entity\Equipe;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

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
            TextField::new('imageFile', 'Bannière pour la page équipe, entre 1000 et 2000px de large, 1mo max')->setFormType(VichImageType::class, ['required' => true]),
            ImageField::new('banner')
                        ->setBasePath(' uploads/img')->onlyOnIndex(),
        ];
    }
}
