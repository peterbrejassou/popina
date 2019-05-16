<?php

namespace App\Controller;

use App\Entity\Restaurant;
use App\Entity\Entree;
use App\Entity\PLat;
use App\Entity\Dessert;
use App\Entity\Boisson;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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
        return $this->render('front/restaurant-detail.html.twig', [
            'restaurant' => $restaurant,
        ]);
    }

    public function restaurantDetailAdmin(Restaurant $restaurant, EntityManagerInterface $em)
    {
        $entrees = $em->getRepository(Entree::class)->findBy(array("restaurant" => $restaurant->getId()));
        $plats = $em->getRepository(Plat::class)->findBy(array("restaurant" => $restaurant->getId()));
        $desserts = $em->getRepository(Dessert::class)->findBy(array("restaurant" => $restaurant->getId()));
        $boissons = $em->getRepository(Boisson::class)->findBy(array("restaurant" => $restaurant->getId()));
        return $this->render('back/restaurant-detail-admin.html.twig', [
            'restaurant' => $restaurant,
            'entrees' => $entrees,
            'plats' => $plats,
            'desserts' => $desserts,
            'boissons' => $boissons,
        ]);
    }


    //form ajout restaurant
    public function addRestaurant(Request $request, EntityManagerInterface $em)
    {
        $resto = new Restaurant();
        $formulaire = $this->createForm(RestaurantType::class, $resto);
        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $file = $resto->getPhoto();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('photos_directory'), $fileName);
            $resto->setPhoto($fileName);

            $em->persist($resto);
            $em->flush();   
            
            return $this->redirectToRoute('restaurant_detail_admin', ['id' => $resto->getId()]);
        }
       
        return $this->render('back/form/add-restaurant.html.twig', [
            'form' => $formulaire->createView(),
        ]);
    }

    //ajout d'une entrée
    public function addEntree(Request $request, EntityManagerInterface $em, Restaurant $restaurant)
    {
        $entree = new Entree();
        $entree_ajout = $this->createForm(EntreeType::class, $entree);
        $entree_ajout->handleRequest($request);

        if ($entree_ajout->isSubmitted() && $entree_ajout->isValid()){
            $restaurant->addEntree($entree);
            $em->persist($entree);
            $em->flush();

            return $this->redirectToRoute('restaurant_detail_admin', ['id' => $restaurant->getId()]);
        }
       
        return $this->render('back/form/add-entree.html.twig',
         [
            'restaurant' => $restaurant,
            'entree' => $entree_ajout->createView(),
        ]);
    }

    // ajout d'un plat
    public function addPlat(Request $request, EntityManagerInterface $em, Restaurant $restaurant)
    {
        $plat = new Plat();
        $plat_ajout = $this->createForm(PlatType::class, $plat);
        $plat_ajout->handleRequest($request);

        if ($plat_ajout->isSubmitted() && $plat_ajout->isValid()) {
            $restaurant->addPLat($plat);
            $em->persist($plat);
            $em->flush();
        }
        
        return $this->render('back/form/add-plat.html.twig',
        [
            'restaurant' => $restaurant,
            'plat' => $plat_ajout->createView(),
        ]);
    }

    // ajout d'un dessert
    public function addDessert(Request $request, EntityManagerInterface $em, Restaurant $restaurant)
    {
        $dessert = new Dessert();
        $dessert_ajout = $this->createForm(DessertType::class, $dessert);
        $dessert_ajout->handleRequest($request);

        if ($dessert_ajout->isSubmitted() && $dessert_ajout->isValid()) {
            $restaurant->addDessert($dessert);
            $em->persist($dessert);
            $em->flush();
        }
        
        return $this->render('back/form/add-dessert.html.twig',
        [
            'restaurant' => $restaurant,
            'dessert' => $dessert_ajout->createView(),
        ]);
    }


    // ajout d'une boisson
    public function addBoisson(Request $request, EntityManagerInterface $em, Restaurant $restaurant)
    {
        $boisson = new Boisson();
        $boisson_ajout = $this->createForm(BoissonType::class, $boisson);
        $boisson_ajout->handleRequest($request);

        if ($boisson_ajout->isSubmitted() && $boisson_ajout->isValid()) {
            $restaurant->addBoisson($boisson);
            $em->persist($boisson);
            $em->flush();
        }
        
        return $this->render('back/form/add-boisson.html.twig',
        [
            'restaurant' => $restaurant,
            'boisson' => $boisson_ajout->createView(),
        ]);
    }

    public function contact(\Swift_Mailer $mailer, Restaurant $restaurant)
    {
        $contactForm = $this->createFormBuilder()
            ->add('email', EmailType::class, ['label' => 'form.email'])
            ->add('content', TextareaType::class, ['label' => 'form.message'])
            ->add('save', SubmitType::class, ['label' => 'form.send'])
            ->getForm();

        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
            $message = (new \Swift_Message('Contact depuis La Popina'))
                ->setFrom('peter.brejassou@gmail.com')
                ->setTo('lola.gauchet@gmail.com')
                ->setBody($this->renderView('back/emails/mail-contact.html.twig', ['restaurant' => $restaurant]), 'text/html');

            $mailer->send($message);
        }

        return $this->render('front/form/contact.html.twig', [
            'contact' => $contactForm->createView(),
        ]);
    }

}