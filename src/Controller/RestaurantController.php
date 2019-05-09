<?php

namespace App\Controller;

use App\Entity\Restaurant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use App\Form\RestaurantType;

class RestaurantController extends AbstractController
{
    public function restaurantDetail(Restaurant $restaurant)
    {
        return $this->render('restaurant-detail.html.twig', [
            'restaurant' => $restaurant,
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

            $this->addFlash(
                'notice',
                'Votre restaurant a bien été ajouté'
            );
            
            return $this->render('restaurant-detail-admin.html.twig', ['restaurant' => $resto]);
        }
       
        return $this->render('form/new.html.twig', [
            'form' => $formulaire->createView(),
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
                ->setBody($this->renderView('emails/mail-contact.html.twig', ['restaurant' => $restaurant]), 'text/html');

            $mailer->send($message);
        }

        return $this->render('form/contact.html.twig', [
            'contact' => $contactForm->createView(),
        ]);
    }
}