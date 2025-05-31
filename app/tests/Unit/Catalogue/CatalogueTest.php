<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Acme\Catalogue;
use Acme\Product;


final class CatalogueTest extends TestCase
{
    
    public function testAddProduct(): void
    {
        $product = new Product('R01', 'Red Widget', 32.95);
        $catalogue = new Catalogue([]);
        $catalogue->addProduct($product);
        $this->assertSame($product, $catalogue->getProductByCode('R01'));
    }

    public function testGetProductByCode(): void
    {
        $product = new Product('G01', 'Green Widget', 24.95);
        $catalogue = new Catalogue([]);
        $catalogue->addProduct($product);
        $this->assertSame($product, $catalogue->getProductByCode('G01'));
    }

    public function testGetProductByCodeReturnsNullIfNotFound(): void
    {
        $catalogue = new Catalogue([]);
        $this->assertNull($catalogue->getProductByCode('NOT_FOUND'));
    }

    public function testGetAllProducts(): void
    {
        $catalogue = new Catalogue([
            new Product('R01', 'Red Widget', 32.95),
            new Product('G01', 'Green Widget', 24.95),
            new Product('B01', 'Blue Widget', 7.95)
        ]);

        $allProducts = $catalogue->getAllProducts();

        $this->assertCount(3, $allProducts);
        $this->assertArrayHasKey('R01', $allProducts);
        $this->assertArrayHasKey('G01', $allProducts);
        $this->assertArrayHasKey('B01', $allProducts);
    }

 }