<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class VoyageController extends AbstractController
{
    #[Route('/voyage', name: 'app_voyage')]
    public function index(): Response
    {
        return $this->render('voyage/index.html.twig', [
            'controller_name' => 'VoyageController',
        ]);
    }
    #[Route('/voyage/{id-voyage}', name: 'app_voyage_id')]
    public function IdVoyage(): Response
    {
        return $this->render('voyage/index.html.twig', [
            'controller_name' => 'VoyageController',
        ]);
    }
    #[Route('/createvoyage', name: 'app_create_voyage')]
    public function create(): Response
    {
        return $this->render('voyage/index.html.twig', [
            'controller_name' => 'VoyageController',
        ]);
    }
}
