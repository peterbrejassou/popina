<?php

namespace App\Controller;

use App\Entity\Restaurant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    public function admin(EntityManagerInterface $em)
    {
        $restaurants = $em->getRepository(Restaurant::class)->findAll();
        return $this->render('back/admin.html.twig', [
            'restaurants' => $restaurants
        ]);
    }
}