<?php

namespace App\Controller;

use App\Entity\Restaurant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function home(EntityManagerInterface $em)
    {
        $restaurants = $em->getRepository(Restaurant::class)->findAll();
        return $this->render('/front/home.html.twig', [
            'restaurants' => $restaurants
        ]);
    }

    public function homeFiltered(EntityManagerInterface $em, $filter)
    {
        $restaurants = $em->getRepository(Restaurant::class)->findBy(array('type' => $filter));
        return $this->render('/front/home.html.twig', [
            'restaurants' => $restaurants
        ]);
    }
}