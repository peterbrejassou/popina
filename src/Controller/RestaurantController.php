<?php

namespace App\Controller;

use App\Entity\Restaurant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RestaurantController extends AbstractController
{
    public function restaurantDetail(Restaurant $restaurant)
    {
        return $this->render('restaurant-detail.html.twig', [
            'restaurant' => $restaurant,
        ]);
    }
}