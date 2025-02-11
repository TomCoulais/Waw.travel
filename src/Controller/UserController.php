<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\RoadTrip;
use App\Form\RoadTripUpdateType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    #[Route('/profil', name: 'app_profile')]
    public function profile(EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('user/profile.html.twig', [
            'user' => $user,
        ]);
    }
    #[Route('/{username}/roadtrips', name: 'app_user_roadtrip')]
    public function user_show(EntityManagerInterface $entityManager, string $username): Response
    {
        $userRepository = $entityManager->getRepository(User::class);
        $user = $userRepository->findOneBy(['username' => $username]);

        if (!$user) {
            throw $this->createNotFoundException('L\'utilisateur n\'existe pas.');
        }

        $roadtripRepository = $entityManager->getRepository(RoadTrip::class);
        $roadtrips = $roadtripRepository->findBy(['user' => $user]);

        // Retourner la vue avec les road trips
        return $this->render('user/show-roadtrip.html.twig', [
            'roadtrips' => $roadtrips,
        ]);
    }
    
    #[Route('/profil/roadtrip/modifier/{id}', name: 'app_update_roadtrip', methods: ['GET', 'POST'])]
    public function update($id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $roadTrip = $entityManager->getRepository(RoadTrip::class)->find($id);
    
        if (!$roadTrip) {
            $this->addFlash('error', 'Road trip introuvable.');
            return $this->redirectToRoute('app_user_roadtrip', ['username' => $roadTrip->getUser()->getUsername()]);
        }
    
        $form = $this->createForm(RoadTripUpdateType::class, $roadTrip);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($roadTrip->getCheckpoints() as $checkpoint) {
                $checkpoint->setRoadTrip($roadTrip);
            }
    
            $entityManager->flush();
            $this->addFlash('success', 'Votre road trip a été mis à jour avec succès!');
            return $this->redirectToRoute('app_user_roadtrip', ['username' => $roadTrip->getUser()->getUsername()]);
        }
    
        return $this->render('user/update-roadtrip.html.twig', [
            'form' => $form,
        ]);
    }
    

    #[Route('/profil/roadtrip/supprimer/{id}', name: 'app_delete_roadtrip', methods: ['GET'])]
    public function delete($id, EntityManagerInterface $entityManager): Response
    {
        $roadTrip = $entityManager->getRepository(RoadTrip::class)->find($id);
    
        if (!$roadTrip) {
            throw $this->createNotFoundException('Le voyage n\'existe pas.');
        }
    
        $entityManager->remove($roadTrip);
        $entityManager->flush();

        $this->addFlash('success', 'Le voyage a été supprimé avec succès.');
        return $this->redirectToRoute('app_user_roadtrip', ['username' => $roadTrip->getUser()->getUsername()]);
    }
}
