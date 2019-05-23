<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class RestaurantControllerTest extends WebTestCase
{
    /*
     * Test d'affichage page détail d'un restaurant
     */
    public function testShowRestaurantDetail()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $link = $crawler
            ->filter('a:contains("détail")') // find all links with the text "Greet"
            ->eq(0) // select the second link in the list
            ->link();

        $crawler = $client->click($link);

        // Vérification de l'obtention du code de status 200 -> OK
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Le status code de la page n'est pas 200.");
        // Vérification du nombre de h2 dans la page -> 5 pour la page détail restaurant
        $this->assertCount(5, $crawler->filter('h2'), "Il n'y a pas 5 h2 dans la page");
        // Vérification du nombre de h3 dans la page -> 4 pour la page détail restaurant
        $this->assertCount(4, $crawler->filter('h3'), "Il n'y a pas 4 h3 dans la page");
    }

    /*
     * Test d'insertion d'un restaurant
     */
    public function testAddNewRestaurant()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/admin/add-restaurant');
        $form = $crawler->selectButton('créer')->form();

        $photo = new UploadedFile(
            './public/icon.png',
            'icon.png',
            'image/png',
            null
        );

        $form['restaurant[slug]'] = 'my-restaurant';
        $form['restaurant[nom]'] = 'My Restaurant';
        $form['restaurant[adresse]'] = 'adresse test';
        $form['restaurant[code_postal]'] = '44000';
        $form['restaurant[ville]'] = 'Nantes';
        $form['restaurant[telephone]'] = '0202020202';
        $form['restaurant[email]'] = 'my-restaurant@test.com';
        $form['restaurant[site_web]'] = 'www.my-restaurant.com';
        $form['restaurant[horaires]'] = '10h-22h';
        $form['restaurant[type]'] = 1;
        $form['restaurant[photo]'] = $photo;
        $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->filter('html:contains("My Restaurant")')->count());
    }

    /*
     * Test de suppression d'un restaurant
     */
    public function testDeleteRestaurant()
    {
        $client = static::createClient();

        $client->request(
            'DELETE',
            '/admin/restaurant/my-restaurant/remove'
        );

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
}