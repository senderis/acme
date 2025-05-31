<?php

declare(strict_types=1);

namespace Acme;

final class Catalogue
{
    /**
     * @var array<Product> $products
     **/
    private array $products = [];
    /**
     * @param array<Product> $products
     **/
    public function __construct(array $products)
    {
        foreach ($products as $product) {
            $this->addProduct($product);
        }
    }

    public function addProduct(Product $product): void
    {
        $this->products[$product->getCode()] = $product;
    }

    public function getProductByCode(string $code): ?Product
    {
        return $this->products[$code] ?? null;
    }

    /**
     * @return array<Product>
     */
    public function getAllProducts(): array
    {
        return $this->products;
    }
}
