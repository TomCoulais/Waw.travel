<?php

namespace App\Controller;

use App\Entity\RoadTrip;
use App\Entity\User;
use App\Form\RoadTripType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class RoadTripController extends AbstractController
{
    #[Route('/roadtrip', name: 'app_roadtrips')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(RoadTrip::class);
        
        $communityRoadTrip = $repository->findBy(['isCommunity' => true]);
        
        return $this->render('roadtrip/index.html.twig', [    
            'communityRoadTrip' => $communityRoadTrip,
        ]);
    }

    #[Route('/roadtrip/ajouter', name: 'app_new_roadtrip')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $roadTrip = new RoadTrip();
        $user = $this->getUser();
    
        if ($user) {
            $roadTrip->setUser($user);
        }
    
        $form = $this->createForm(RoadTripType::class, $roadTrip);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $coverImageFile = $form->get('coverImage')->getData();
    
            if ($coverImageFile) {
                $newFilename = uniqid() . '.' . $coverImageFile->guessExtension();
    
                try {
                    $coverImageFile->move(
                        $this->getParameter('uploads_directory'),
                        $newFilename
                    );
                    $roadTrip->setCoverImage($newFilename);
                } catch (FileException $e) {
                    $this->addFlash('error', 'Une erreur s\'est produite lors du téléchargement de l\'image.');
                }
            }
    
            $entityManager->persist($roadTrip);
            $entityManager->flush();
    
            $this->addFlash('success', 'Votre roadtrip a été créé avec succès!');
            return $this->redirectToRoute('app_roadtrips');
        }
    
        return $this->render('roadtrip/new.html.twig', [
            'controller_name' => 'VoyageController',
            'form' => $form,
        ]);
        }

        #[Route('/roadtrip/{id}', name: 'app_search_roadtrip')]
        public function search($id, EntityManagerInterface $entityManager): Response
        {
            $roadtrips = $entityManager->getRepository(RoadTrip::class)->find($id);
    
            if (!$roadtrips) {
                throw $this->createNotFoundException('Le voyage n\'existe pas.');
            }
    
            return $this->render('roadtrip/show.html.twig', [
                'roadtrips' => $roadtrips
            ]);
        }     
}
    
