<?php

namespace App\Controller;

use App\Entity\Restaurant;
use App\Entity\Entree;
use App\Entity\PLat;
use App\Entity\Dessert;
use App\Entity\Boisson;
use App\Controller\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\HttpFoundation\Request;
use App\Form\RestaurantType;
use App\Form\EntreeType;
use App\Form\PlatType;
use App\Form\DessertType;
use App\Form\BoissonType;

class RestaurantController extends AbstractController
{
    public function restaurantDetail(Restaurant $restaurant)
    {
        return $this->render('restaurant-detail.html.twig', [
            'restaurant' => $restaurant,
        ]);
    }

    public function restaurantDetailAdmin(Restaurant $restaurant)
    {
        return $this->render('restaurant-detail-admin.html.twig', [
            'restaurant' => $restaurant,
        ]);
    }


    //form ajout restaurant
    public function addRestaurant(Request $request)
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
            
            return $this->redirectToRoute('restaurant-detail-admin', ['id' => $form->getId()]);
        }
       
        return $this->render('form/new.html.twig', [
            'form' => $formulaire->createView(),
        ]);
    }


    //ajout d'une entrée
    public function addEntree(Request $request, Restaurant $restaurant)
    {
        $entree = new Entree();

        $entree_ajout = $this->createForm(EntreeType::class, $entree);

        $entree_ajout->handleRequest($request);

        if ($entree_ajout->isSubmitted() && $entree_ajout->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $restaurant->addEntree($entree);
            $em->persist($entree);
            $em->flush();

            return $this->redirectToRoute('restaurant-detail-admin', ['id' => $restaurant->getId()]);
        }
       
        return $this->render('form/add-entree.html.twig', 
         [
            'restaurant' => $restaurant,
            'entree' => $entree_ajout->createView(),
        ]);
    }

    // ajout d'un plat
    public function addPlat(Request $request, Restaurant $restaurant)
    {
        $plat = new Plat();

        $plat_ajout = $this->createForm(PlatType::class, $plat);

        $plat_ajout->handleRequest($request);

        if ($plat_ajout->isSubmitted() && $plat_ajout->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            $restaurant->addPLat($plat);
            $em->persist($plat);
            $em->flush();
        }
        
        return $this->render('form/add-plat.html.twig', 
        [
            'restaurant' => $restaurant,
            'plat' => $plat_ajout->createView(),
        ]);
    }

    // ajout d'un dessert
    public function addDessert(Request $request, Restaurant $restaurant)
    {
        $dessert = new Dessert();

        $dessert_ajout = $this->createForm(DessertType::class, $dessert);

        $dessert_ajout->handleRequest($request);

        if ($dessert_ajout->isSubmitted() && $dessert_ajout->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            $restaurant->addDessert($dessert);
            $em->persist($dessert);
            $em->flush();
        }
        
        return $this->render('form/add-dessert.html.twig', 
        [
            'restaurant' => $restaurant,
            'dessert' => $dessert_ajout->createView(),
        ]);
    }


    // ajout d'une boisson
    public function addBoisson(Request $request, Restaurant $restaurant)
    {
        $boisson = new Boisson();

        $boisson_ajout = $this->createForm(BoissonType::class, $boisson);

        $boisson_ajout->handleRequest($request);

        if ($boisson_ajout->isSubmitted() && $boisson_ajout->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            $restaurant->addBoisson($boisson);
            $em->persist($boisson);
            $em->flush();
        }
        
        return $this->render('form/add-boisson.html.twig', 
        [
            'restaurant' => $restaurant,
            'boisson' => $boisson_ajout->createView(),
        ]);
    }
   


}