<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends AbstractController
{
    /**
     * @var ProductRepository
     */
    private $repository;

    public function __construct(EntityManagerInterface $entityManager, ProductRepository $repository)
    {
        parent::__construct($entityManager);

        $this->repository = $repository;
    }

    /**
     * @return Response
     * @Route("/products", name="product_list")
     */
    public function list(): Response
    {
        return $this->render(
            'product/list.html.twig',
            [
                'products' => $this->repository->findAllActive(),
            ]
        );
    }

    /**
     * @param Product $product
     * @Route("/products/delete/{id}", name="product_delete")
     * @return Response
     */
    public function delete(Product $product): Response
    {
        $product->setActive(false);
        $this->entityManager->flush();

        return new RedirectResponse("/products");
    }
}