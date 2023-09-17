<?php

namespace App\Controller\Admin;

use App\Entity\GH;
use App\Entity\GHU;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\Security\Core\Authorization\Voter\AuthenticatedVoter;

class DashboardController extends AbstractDashboardController
{

    #[Route('/', name: 'admin')]

    #Permet d'afficher le dashboard uniquement si un utilisateur est connecté

    #[IsGranted(AuthenticatedVoter::IS_AUTHENTICATED_FULLY)]

    public function index(): Response
    {

        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Agence88 - Administrateur')
            ->renderContentMaximized();
    }



    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoRoute('Accueil', 'fas fa-home', 'admin');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class)
            #Permission d'accéder à cette partie selon le role de l'utilisateur
            ->setPermission('ROLE_DIR_INFORMATIQUE');
        yield MenuItem::linkToCrud('GHU', 'fas fa-hospital', GHU::class)
            #Permission d'accéder à cette partie selon le role de l'utilisateur
            ->setPermission('ROLE_DIR_GHU');
        yield MenuItem::linkToCrud('Etablissement', 'fas fa-house', GH::class)
            #Permission d'accéder à cette partie selon le role de l'utilisateur
            ->setPermission('ROLE_DIR_GH')
            ->setPermission('ROLE_DIR_GHU');
    }
}
