<?php

namespace App\Tests;

use App\DataFixtures\AppFixtures;
use Liip\FunctionalTestBundle\Test\WebTestCase;

abstract class FunctionalTest extends WebTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    protected function setUp()
    {
        parent::setUp();

        $this->loadFixtures(
            [
                AppFixtures::class,
            ]
        );

        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    protected function tearDown(): void
    {
        $this->loadFixtures(
            [
                AppFixtures::class,
            ]
        );

        $this->entityManager->close();
        $this->entityManager = null; // avoid memory leaks
    }
}