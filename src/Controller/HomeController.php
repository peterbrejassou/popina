<?php

namespace App\Controller;

use App\Entity\Restaurant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function welcome()
    {
        return $this->render('base.html.twig');
    }

    public function home()
    {
        $restaurants = $this->getDoctrine()->getRepository(Restaurant::class)->findAll();
        return $this->render('home.html.twig', [
            'restaurants' => $restaurants
        ]);
    }
}