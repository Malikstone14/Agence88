<?php

namespace App\Form;

use App\Entity\GHU;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ghu', EntityType::class, [
                'class' => GHU::class,
                'choice_label' => 'nom', // Nom de l'attribut à afficher dans la liste
                'placeholder' => 'Sélectionnez un GHU', // Texte de l'option par défaut
                'required' => true, // Ou false si le champ n'est pas obligatoire
            ])
            ->add('email')
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Directeur Informatique' => 'ROLE_DIR_INFORMATIQUE',
                    'Directeur GHU' => 'ROLE_DIR_GHU',
                    'Utilisateur' => 'ROLE_USER',
                    'Directeur GH' => 'ROLE_DIR_GH',
                    'Directeur Commercial' => 'ROLE_DIR_COM',
                    'Agent Plannificateur GHU' => 'ROLE_AGENT',
                    'Technicien Déploiement GHU' => 'ROLE_TECH_GHU',
                ],


            ])

            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'property_path' => 'password',
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ]);
        $builder->get('roles')
            ->addModelTransformer(new CallbackTransformer(
                fn ($rolesAsArray) => count($rolesAsArray) ? $rolesAsArray[0] : null,
                fn ($rolesAsString) => [$rolesAsString]
            ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
