<?php

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/create_user", name="create_user")
     */
    public function createUser(): Response
    {
        // Créez une instance de l'entité User
        $user = new User();

        // Définissez l'e-mail et le mot de passe de l'utilisateur
        $user->setEmail('nouvel_utilisateur@example.com');
        $user->setPassword('mot_de_passe_securise'); // Assurez-vous de hasher le mot de passe, ne stockez pas le mot de passe en texte brut.

        // Ajoutez des rôles à l'utilisateur (par exemple, ROLE_USER et ROLE_ADMIN)
        $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);

        // Enregistrez l'utilisateur dans la base de données
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return new Response('Utilisateur créé avec succès avec des rôles.');
    }
}
