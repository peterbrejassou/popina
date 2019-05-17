<?php

namespace App\Controller;

use App\Entity\Restaurant;
use App\Entity\Entree;
use App\Entity\Plat;
use App\Entity\Dessert;
use App\Entity\Boisson;
use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Psr\Log\LoggerInterface;
use App\Form\RestaurantType;
use App\Form\EntreeType;
use App\Form\PlatType;
use App\Form\DessertType;
use App\Form\BoissonType;
use App\Form\ContactType;

class RestaurantController extends AbstractController
{
    public function restaurantDetail(Restaurant $restaurant,  EntityManagerInterface $em)
    {
        $entrees = $em->getRepository(Entree::class)->findBy(array("restaurant" => $restaurant->getId()));
        $plats = $em->getRepository(Plat::class)->findBy(array("restaurant" => $restaurant->getId()));
        $desserts = $em->getRepository(Dessert::class)->findBy(array("restaurant" => $restaurant->getId()));
        $boissons = $em->getRepository(Boisson::class)->findBy(array("restaurant" => $restaurant->getId()));
        return $this->render('front/restaurant-detail.html.twig', [
            'restaurant' => $restaurant,
            'entrees' => $entrees,
            'plats' => $plats,
            'desserts' => $desserts,
            'boissons' => $boissons,
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
    public function addRestaurant(Request $request, EntityManagerInterface $em, LoggerInterface $logger)
    {
        $logger->info('Un restaurant a été ajouté');

        $restaurant = new Restaurant(null, null, null, null, null, null, null, null, null, null, null, null);
        $formulaire = $this->createForm(RestaurantType::class, $restaurant);
        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $file = $restaurant->getPhoto();

            if($file){
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move($this->getParameter('photos_directory'), $fileName);
                $restaurant->setPhoto($fileName);
            }

            $em->persist($restaurant);
            $em->flush();   
            
            return $this->redirectToRoute('restaurant_detail_admin', ['slug' => $restaurant->getSlug()]);
        }
       
        return $this->render('back/form/add-restaurant.html.twig', [
            'form' => $formulaire->createView(),
        ]);
    }

    //ajout d'une entrée
    public function addEntree(Request $request, EntityManagerInterface $em, Restaurant $restaurant)
    {
        $entree = new Entree(null, null, null, null, null, null);
        $entree_ajout = $this->createForm(EntreeType::class, $entree);
        $entree_ajout->handleRequest($request);

        if ($entree_ajout->isSubmitted() && $entree_ajout->isValid()){
            $restaurant->addEntree($entree);
            $em->persist($entree);
            $em->flush();

            return $this->redirectToRoute('restaurant_detail_admin', ['slug' => $restaurant->getSlug()]);
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
        $plat = new Plat(null, null, null, null, null, null);
        $plat_ajout = $this->createForm(PlatType::class, $plat);
        $plat_ajout->handleRequest($request);

        if ($plat_ajout->isSubmitted() && $plat_ajout->isValid()) {
            $restaurant->addPLat($plat);
            $em->persist($plat);
            $em->flush();

            return $this->redirectToRoute('restaurant_detail_admin', ['slug' => $restaurant->getSlug()]);
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
        $dessert = new Dessert(null, null, null, null, null, null);
        $dessert_ajout = $this->createForm(DessertType::class, $dessert);
        $dessert_ajout->handleRequest($request);

        if ($dessert_ajout->isSubmitted() && $dessert_ajout->isValid()) {
            $restaurant->addDessert($dessert);
            $em->persist($dessert);
            $em->flush();

            return $this->redirectToRoute('restaurant_detail_admin', ['slug' => $restaurant->getSlug()]);
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
        $boisson = new Boisson(null, null, null, null, null, null, null);
        $boisson_ajout = $this->createForm(BoissonType::class, $boisson);
        $boisson_ajout->handleRequest($request);

        if ($boisson_ajout->isSubmitted() && $boisson_ajout->isValid()) {
            $restaurant->addBoisson($boisson);
            $em->persist($boisson);
            $em->flush();

            return $this->redirectToRoute('restaurant_detail_admin', ['slug' => $restaurant->getSlug()]);
        }

        return $this->render('back/form/add-boisson.html.twig',
        [
            'restaurant' => $restaurant,
            'boisson' => $boisson_ajout->createView(),
        ]);
    }

    public function contact(Request $request, \Swift_Mailer $mailer, Restaurant $restaurant, EntityManagerInterface $em)
    {
        $contact = new Contact();
        $contact_form =  $this->createForm(ContactType::class, $contact);
        $contact_form->handleRequest($request);

        if ($contact_form->isSubmitted() && $contact_form->isValid()) {
            $mail = $contact_form['mail']->getData();
            $content = $contact_form['message']->getData();
            $name = $contact_form['name']->getData();
            $lastname = $contact_form['lastname']->getData();
            $phone = $contact_form['phone']->getData();

            $contact->setMail($mail);
            $contact->setMessage($content);          

            $em->persist($contact);
            $em->flush();   

            $message = (new \Swift_Message('Confirmation Demande de contact depuis La Popina'))
                ->setFrom('peter.brejassou@gmail.com')
                ->setTo($mail)
                ->setBody($this->renderView('back/emails/confirmation-contact-mail.html.twig', ['mail' => $mail, 'nom' => $restaurant->getNom(), 'phone' => $restaurant->getTelephone()]), 'text/html');

            $mailer->send($message);

            $message_restaurant = (new \Swift_Message('Demande de contact depuis La Popina'))
                ->setFrom('peter.brejassou@gmail.com')
                ->setTo($restaurant->getEmail())
                ->setBody($this->renderView('back/emails/contact-mail.html.twig', ['name' => $name, 'lastname' => $lastname, 'phone' => $phone, 'content' => $content, 'mail' => $mail]), 'text/html');

            $mailer->send($message_restaurant);

            return $this->redirectToRoute('restaurant_detail', ['id' => $restaurant->getId()]);
        }

        return $this->render('front/form/contact.html.twig', [
            'contact' => $contact_form->createView(),
        ]);
    }

    // Suppression d'un restaurant
    public function removeRestaurant(EntityManagerInterface $em, Restaurant $restaurant)
    {
        $em->remove($restaurant);
        $em->flush();
        return $this->redirectToRoute('admin');
    }

    // Suppression d'une entrée
    public function removeEntree(EntityManagerInterface $em, String $slug_restaurant, Entree $entree)
    {
        $em->remove($entree);
        $em->flush();

        return $this->redirectToRoute('restaurant_detail_admin', ['slug' => $slug_restaurant]);
    }

    // Suppression d'un plat
    public function removePlat(EntityManagerInterface $em, String $slug_restaurant, Plat $plat)
    {
        $em->remove($plat);
        $em->flush();

        return $this->redirectToRoute('restaurant_detail_admin', ['slug' => $slug_restaurant]);
    }

    // Suppression d'un dessert
    public function removeDessert(EntityManagerInterface $em, String $slug_restaurant, Dessert $dessert)
    {
        $em->remove($dessert);
        $em->flush();

        return $this->redirectToRoute('restaurant_detail_admin', ['slug' => $slug_restaurant]);
    }

    // Suppression d'une boisson
    public function removeBoisson(EntityManagerInterface $em, String $slug_restaurant, Boisson $boisson)
    {
        $em->remove($boisson);
        $em->flush();

        return $this->redirectToRoute('restaurant_detail_admin', ['slug' => $slug_restaurant]);
    }

    // Mise à jour d'un restaurant
    public function updateRestaurant(Request $request, EntityManagerInterface $em, Restaurant $restaurant)
    {
        $photo = new File($this->getParameter('photos_directory') . '/'. $restaurant->getPhoto());
        $restaurant->setPhoto($photo);
        $restaurant_update = $this->createForm(RestaurantType::class, $restaurant);
        $restaurant_update->handleRequest($request);

        if ($restaurant_update->isSubmitted() && $restaurant_update->isValid()) {
            $file = $restaurant->getPhoto();

            if($file){
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move($this->getParameter('photos_directory'), $fileName);
                $restaurant->setPhoto($fileName);
            }

            $em->flush();

            return $this->redirectToRoute('restaurant_detail_admin', ['slug' => $restaurant->getSlug()]);
        }

        return $this->render('back/form/update-restaurant.html.twig', [
            'update_restaurant' => $restaurant_update->createView(),
        ]);
    }
}