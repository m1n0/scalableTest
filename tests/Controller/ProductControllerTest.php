<?php

namespace App\Tests\Controller;

use App\Entity\Product;
use App\Tests\FunctionalTest;

class ProductControllerTest extends FunctionalTest
{
    public function testSoftDelete(): void
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/products');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertEquals(
            4,
            $crawler->filter('tr')->count()
        );

        // Click on one of the delete links.
        $link = $crawler
            ->filter('a:contains("Delete")')
            ->eq(1)
            ->link();
        $crawler = $client->click($link);

        // One less item should be visible.
        $crawler = $client->request('GET', '/products');
        $this->assertEquals(
            3,
            $crawler->filter('tr')->count()
        );

        // Number of items in db should remain the same though.
        $allProducts = $this->entityManager
            ->getRepository(Product::class)
            ->findAll();
        $this->assertCount(4, $allProducts);
    }
}