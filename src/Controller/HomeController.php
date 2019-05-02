<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function welcome()
    {
        return $this->render('base.html.twig');
    }

    public function home()
    {
        return $this->render('home.html.twig');
    }
}