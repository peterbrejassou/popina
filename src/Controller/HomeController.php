<?php

namespace App\Controller;

use App\Entity\Restaurant;
use App\Entity\TypeRestaurant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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

    // public function changeLocale(Request $request)
    // {
        
    //     $form = $this->createFormBuilder(null)
    //         ->add('locale', ChoiceType::class, [
    //             'choices' =>  [
    //                 'Français' => 'fr',
    //                 'Italien' => 'it'
    //             ]
    //         ])
    //         ->add('save', SubmitType::class, ['label' => 'Create Task'])
    //         ->getForm();

    //     return $this->render('/front/home.html.twig', [
    //         'form' => $form->createView(),
    //     ]);
    // }
}