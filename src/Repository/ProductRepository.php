<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository
{
    public function findAllActive(): array
    {
        return $this->findBy(
            [
                'active' => true,
            ]
        );
    }
}