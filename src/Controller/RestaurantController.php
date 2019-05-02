<?php

namespace App\Controller;

use App\Entity\Restaurant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RestaurantController extends AbstractController
{
    public function restaurantDetail($id)
    {
        $restaurant = $this->getDoctrine()
            ->getRepository(Restaurant::class)
            ->find($id);

        return $this->render('restaurant-detail.html.twig', [
            'restaurant' => $restaurant,
        ]);
    }
}