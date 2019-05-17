<?php

namespace App\DataFixtures;
use App\Entity\Boisson;
use App\Entity\Dessert;
use App\Entity\Plat;
use App\Entity\Restaurant;
use App\Entity\Entree;
use App\Entity\TypeRestaurant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // TYPES DE RESTAURANT
        $type_restaurant1 = new TypeRestaurant(1,'asiatique', 'Asiatique', null);
        $type_restaurant2 = new TypeRestaurant(2,'bar', 'Bar', null);
        $type_restaurant3 = new TypeRestaurant(3,'cuisine-francaise', 'Cuisine française', null);
        $type_restaurant4 = new TypeRestaurant(4,'espagnol', 'Espagnol', null);
        $type_restaurant5 = new TypeRestaurant(5,'fast-food', 'Fast food', null);
        $type_restaurant6 = new TypeRestaurant(6,'hawaien', 'Hawaïen', null);
        $type_restaurant7 = new TypeRestaurant(7,'indien', 'Indien', null);
        $type_restaurant8 = new TypeRestaurant(8,'italien','Italien', null);
        $type_restaurant9 = new TypeRestaurant(9,"mexicain", 'Mexicain', null);
        $type_restaurant10 = new TypeRestaurant(10,"street-food", 'Street food', null);

        $this->addReference("type_restaurant1", $type_restaurant1);
        $this->addReference("type_restaurant2", $type_restaurant2);
        $this->addReference("type_restaurant3", $type_restaurant3);
        $this->addReference("type_restaurant4", $type_restaurant4);
        $this->addReference("type_restaurant5", $type_restaurant5);
        $this->addReference("type_restaurant6", $type_restaurant6);
        $this->addReference("type_restaurant7", $type_restaurant7);
        $this->addReference("type_restaurant8", $type_restaurant8);
        $this->addReference("type_restaurant9", $type_restaurant9);
        $this->addReference("type_restaurant10", $type_restaurant10);

        $manager->persist($type_restaurant1);
        $manager->persist($type_restaurant2);
        $manager->persist($type_restaurant3);
        $manager->persist($type_restaurant4);
        $manager->persist($type_restaurant5);
        $manager->persist($type_restaurant6);
        $manager->persist($type_restaurant7);
        $manager->persist($type_restaurant8);
        $manager->persist($type_restaurant9);
        $manager->persist($type_restaurant10);


        // RESTAURANTS
        $restaurant1 = new Restaurant(1, "creperie-ker-breiz","Creperie Ker Breiz", "11 rue de l'Heronniere", "44000", "Nantes", "02 40 69 80 20", "ker-breizh@test.com", "https://www.facebook.com/kerbreizhnantes?utm_source=tripadvisor&utm_medium=referral", "12:00 - 14:00, 19:00 - 21:30", $this->getReference("type_restaurant3"), "creperie-ker-breiz.jpg");
        $restaurant2 = new Restaurant(2, "le-bistro-des-enfants-nantais","Le Bistro des Enfants Nantais", "4 Rue Desaix", "44000", "Nantes", "02 51 12 15 11", "bistro-enfants-nantais@test.com", "https://www.facebook.com/pages/Le-Bistro-Des-Enfants-Nantais/711713135578225?utm_source=tripadvisor&utm_medium=referral", "12:00 - 14:00, 19:00 - 21:00", $this->getReference("type_restaurant3"), "bistro-enfants-nantais.jpg");
        $restaurant3 = new Restaurant(3, "a-cantina","A Cantina", "28 Rue Kervegan", "44000", "Nantes", "02 40 47 68 83", "a-cantina@test.com", "http://www.a-cantina.fr/?utm_source=tripadvisor&utm_medium=referral", "12:00 - 14:00, 19:00 - 21:30", $this->getReference("type_restaurant3"), "a-cantina.jpg");
        $restaurant4 = new Restaurant(4, "song-saveurs-et-sens","Song Saveurs et Sens", "5 Rue Santeuil", "44000", "Nantes", "02 40 20 88 07", "a-cantina@test.com", "http://www.restaurant-song.fr", "12:00 - 14:00, 19:30 - 22:00", $this->getReference("type_restaurant1"), "song-saveurs-sens.jpg");
        $restaurant5 = new Restaurant(5, "the-red-and-luna","The Red & Luna", "7 Rue de la Juiverie", "44000", "Nantes", "09 83 77 62 48", "theredandluna@test.com", "https://www.facebook.com/pages/category/Kitchen-Cooking/The-red-luna-187359165196464", "12:00 - 14:30, 19:00 - 22:30", $this->getReference("type_restaurant1"), "the-red-and-luna.jpg");
        $restaurant6 = new Restaurant(6, "burger-king-nantes-saint-herblain","Burger King Nantes Saint-Herblain", "299 Route de Vannes", "44800", "Saint-Herblain", "02 85 05 01 99", "burgerking@test.com", "https://www.burgerking.fr", "11:00 - 23:00", $this->getReference("type_restaurant5"), "bk.jpg");

        $this->addReference("restaurant1", $restaurant1);
        $this->addReference("restaurant2", $restaurant2);
        $this->addReference("restaurant3", $restaurant3);
        $this->addReference("restaurant4", $restaurant4);
        $this->addReference("restaurant5", $restaurant5);
        $this->addReference("restaurant6", $restaurant6);

        $manager->persist($restaurant1);
        $manager->persist($restaurant2);
        $manager->persist($restaurant3);
        $manager->persist($restaurant4);
        $manager->persist($restaurant5);
        $manager->persist($restaurant6);


        // ENTRÉES
        $entree1 = new Entree(1, "salade-composee","Salade composée","", 4.00, $this->getReference("restaurant1"));
        $entree2 = new Entree(1, "salade-chevre","Salade chèvre","", 4.50, $this->getReference("restaurant1"));
        $entree3 = new Entree(1, "salade-nicoise","Salade niçoise","", 5.30, $this->getReference("restaurant1"));
        $manager->persist($entree1);
        $manager->persist($entree2);
        $manager->persist($entree3);


        // PLATS
        $plat1 = new Plat(1,"crepe-classique-beurre", "Crêpe Classique Beurre", "", 2.00, $this->getReference("restaurant1"));
        $plat2 = new Plat(2,"crepe-classique-fromage", "Crêpe Classique Fromage", "", 3.50, $this->getReference("restaurant1"));
        $plat3 = new Plat(3,"crepe-complete-tomate", "Crêpe Complète Tomate", "Jambon, oeuf, fromage, tomates", 6.70, $this->getReference("restaurant1"));
        $manager->persist($plat1);
        $manager->persist($plat2);
        $manager->persist($plat3);


        // DESSERTS
        $dessert1 = new Dessert(1,"crepe-sucre","Crêpe Sucre", "", 2.00, $this->getReference("restaurant1"));
        $dessert2 = new Dessert(1,"crepe-nutella","Crêpe Nutella", "", 2.90, $this->getReference("restaurant1"));
        $dessert3 = new Dessert(1,"crepe-framboises","Crêpe Framboises", "", 4.20, $this->getReference("restaurant1"));
        $manager->persist($dessert1);
        $manager->persist($dessert2);
        $manager->persist($dessert3);


        // BOISSONS
        $boisson1 = new Boisson(1,"coca-cola","Coca-Cola", "", 33.0, 2.80,  $this->getReference("restaurant1"));
        $boisson2 = new Boisson(1,"jus-de-fruit","Jus de fruit", "Abricot, ananas, orange", 50.0, 2.80,  $this->getReference("restaurant1"));
        $boisson3 = new Boisson(1,"vittel","Vittel", "", 50.0, 2.80,  $this->getReference("restaurant1"));
        $manager->persist($boisson1);
        $manager->persist($boisson2);
        $manager->persist($boisson3);


        // FLUSH DES DONNÉES
        $manager->flush();
    }
}