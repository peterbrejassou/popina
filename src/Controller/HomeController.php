<?php

namespace App\Controller;

use App\Entity\Restaurant;
use App\Entity\TypeRestaurant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function home(EntityManagerInterface $em)
    {
        $restaurants = $em->getRepository(Restaurant::class)->findAll();
        $allFiltres = $em->getRepository(TypeRestaurant::class)->findAll();
        return $this->render('/front/home.html.twig', [
            'restaurants' => $restaurants,
            'filtres' => $allFiltres
        ]);
    }



    public function homeFiltered(EntityManagerInterface $em, $filter)
    {
        $allFiltres = $em->getRepository(TypeRestaurant::class)->findAll();
        $filterTri = $em->getRepository(TypeRestaurant::class)->findOneBy(array('slug' => $filter));
        $restaurants = $em->getRepository(Restaurant::class)->findBy(array('type' => $filterTri));

        return $this->render('/front/home.html.twig', [
            'restaurants' => $restaurants,
            'filtres' => $allFiltres
        ]);
    }
}