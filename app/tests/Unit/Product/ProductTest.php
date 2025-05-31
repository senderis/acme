<?php

declare(strict_types=1);

use Acme\Product;
use PHPUnit\Framework\TestCase;

final class ProductTest extends TestCase
{
    public function testGetName(): void
    {
        $product = new Product('R01', 'Red Widget', 32.95);
        $this->assertSame('Red Widget', $product->getName());
    }

    public function testGetCode(): void
    {
        $product = new Product('G01', 'Green Widget', 24.95);
        $this->assertSame('G01', $product->getCode());
    }

    public function testGetPrice(): void
    {
        $product = new Product('B01', 'Blue Widget', 7.95);
        $this->assertSame(7.95, $product->getPrice());
    }
}
