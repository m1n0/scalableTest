<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $products = [
            new Product('Product X', 'An awesome product!', 10, true),
            new Product('Product Y', 'This one is nice as well.', 20, true),
            new Product('Product Z', 'Another great option.', 5, true),
            new Product('Product A', 'We dont have this one any more.', 5, false),
        ];

        foreach ($products as $product) {
            $manager->persist($product);
        }
        $manager->flush();
    }
}
