<?php

namespace App\Controller\Admin;

use App\Entity\GH;
use App\Entity\GHU;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class GHCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return GH::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
            TextField::new('nom'),
            IdField::new('ghu.id')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
            TextField::new('ghu.nom')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
            AssociationField::new('ghu', 'GHU')
                ->autocomplete()
                ->setRequired(true)
        ];
    }
}
