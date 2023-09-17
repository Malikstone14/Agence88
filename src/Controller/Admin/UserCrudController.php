<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;


class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural("Utilisateurs")
            ->setEntityLabelInSingular("Utilisateur");
    }


    public function configureFields(string $pageName): iterable
    {
        $passwordField = TextField::new('plainPassword')
            ->setLabel('Mot de passe')
            ->setRequired(true)
            ->hideOnIndex()
            ->hideWhenUpdating()
            ->setFormTypeOption('mapped', false) // Pour ne pas mapper ce champ à l'entité
            ->setFormType(PasswordType::class); // PasswordType pour masquer le texte

        return [
            TextField::new('email'),
            ChoiceField::new('roles')
                ->setLabel('Rôles')
                ->setChoices([
                    'Directeur Informatique' => 'ROLE_DIR_INFORMATIQUE',
                    'Directeur GHU' => 'ROLE_DIR_GHU',
                    'Utilisateur' => 'ROLE_USER',
                    'Directeur GH' => 'ROLE_DIR_GH',
                    'Directeur Commercial' => 'ROLE_DIR_COM',
                    'Agent Plannificateur GHU' => 'ROLE_AGENT',
                    'Technicien Déploiement GHU' => 'ROLE_TECH_GHU',
                ])
                ->allowMultipleChoices()
                ->renderExpanded(),
            AssociationField::new('ghu', 'Affecter à un GHU')
                ->setLabel('GHU')
                ->autocomplete()
                ->setRequired(true),
            $passwordField,
        ];
    }
}
