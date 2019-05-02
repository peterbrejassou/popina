<?php

namespace App\Controller;

use App\Entity\Restaurant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\HttpFoundation\Request;
use App\Form\RestaurantType;

class RestaurantController extends AbstractController
{
    public function restaurantDetail(Restaurant $restaurant)
    {
        return $this->render('restaurant-detail.html.twig', [
            'restaurant' => $restaurant,
        ]);
    }


    //form ajout restaurant
    public function form(Request $request)
    {

        $form = new Restaurant();

        $formulaire = $this->createForm(RestaurantType::class, $form);

        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $file = $form->getPhoto();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('photos_directory'), $fileName);
            $form->setPhoto($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($form);
            $em->flush();

            $this->addFlash(
                'notice',
                'Votre restaurant a bien été ajouté'
            );
            
            return $this->redirectToRoute('home');

        }
       
        return $this->render('form/new.html.twig', [
            'form' => $formulaire->createView(),
        ]);
    }
}