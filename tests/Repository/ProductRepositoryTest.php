<?php

namespace App\Tests\Repository;

use App\Entity\Product;

class ProductRepositoryTest extends EntityRepositoryTest
{
    public function testFindAllActive(): void
    {
        $allProducts = $this->entityManager
            ->getRepository(Product::class)
            ->findAll();

        $activeProducts = $this->entityManager
            ->getRepository(Product::class)
            ->findAllActive();

        $this->assertCount(4, $allProducts);
        $this->assertCount(3, $activeProducts);
    }
}