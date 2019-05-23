<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Bridge\Monolog\Logger;
class SecurityController extends AbstractController
{
    public function register(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder, Logger $utilisateurLog)
    {
        $user = new User(null, null, null, null);
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $encryptPassword = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encryptPassword);
            $manager->persist($user);
            $manager->flush();
            $utilisateurLog->info('un nouvel utilisateur a été ajouté',['nom' => $user->getUsername()]);            
           
            return $this->redirectToRoute('login');
        }

        return $this->render('front/security/registration.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function login()
    {   
        return $this->render('front/security/login.html.twig');
    }

    public function logout(){}
}
