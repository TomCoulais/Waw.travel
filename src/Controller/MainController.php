<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\RoadTrip;
use App\Entity\User;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(RoadTrip::class);
        
        $communityRaodTrip = $repository->findBy(['isCommunity' => true]);
        
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'communityRaodTrip' => $communityRaodTrip,
        ]);
    }
    #[Route('/mentions-legales', name: 'app_mention_legales')]
    public function mentionsLegales(): Response
    {
        return $this->render('main/mentions-legales.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
    
}
