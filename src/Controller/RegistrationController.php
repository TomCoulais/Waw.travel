<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;  
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormError;

class RegistrationController extends AbstractController
{
    #[Route('/inscription', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, Security $security, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);  // Correct form type reference
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var string $plainPassword */
            $plainPassword = $form->get('plainPassword')->getData();
            $confirmPassword = $form->get('confirmPassword')->getData();

            // Vérifier que les mots de passe correspondent
            if ($plainPassword !== $confirmPassword) {
                $form->get('confirmPassword')->addError(new FormError('Passwords do not match.'));
            }

            if (!$form->isValid()) {
                // Si les mots de passe ne correspondent pas, le formulaire ne sera pas validé
                return $this->render('registration/register.html.twig', [
                    'registrationForm' => $form->createView(),
                ]);
            }

            // Assurez-vous que le pseudo est bien défini
            $username = $form->get('username')->getData();
            $user->setUsername($username);

            // Encoder le mot de passe
            $user->setPassword($userPasswordHasher->hashPassword($user, $plainPassword));

            $entityManager->persist($user);
            $entityManager->flush();

            // Connecter l'utilisateur après l'inscription
            return $security->login($user, 'form_login', 'main');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}


