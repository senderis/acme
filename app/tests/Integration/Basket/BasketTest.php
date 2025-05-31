<?php

declare(strict_types=1);

use BaseTest;

class BasketTest extends BaseTest
{

    public function testAddProduct1():void
    {
        $this->basket->add('B01'); // 7.95  
        $this->basket->add('G01'); // 24.95
        // Total: 7.95 + 24.95 = 32.90, + 4.95 delivery cost due less than 50
        $this->assertCount(2, $this->basket->getProducts());
        $this->assertEquals(37.85, $this->basket->total());
    }

    public function testAddProduct2():void
    {
        $this->basket->add('R01'); // 32.95
        $this->basket->add('G01'); // 24.95
        // 32.95 (R01) + 24.95 (G01) = 57.90, + 2.95 delivery cost due less than 90
        $total = $this->basket->total();
        $this->assertCount(2, $this->basket->getProducts());
        $this->assertEquals(60.85, $this->basket->total());
    }
    
    public function testAddProduct3():void
    {
        $this->basket->add('B01'); // 7.95
        $this->basket->add('B01'); // 7.95
        $this->basket->add('R01'); // 32.95
        $this->basket->add('R01'); // 32.95 / 2 = 16.475
        $this->basket->add('R01'); // 32.95  this has no pair so no discount
        // Total: 7.95 + 7.95 + 32.95 + 16.475 + 32.95  = 98.27
        $this->assertEquals(98.27, $this->basket->total());
    }
    
    public function testAddProduct4():void
    {
        $this->basket->add('B01'); // 7.95
        $this->basket->add('B01'); // 7.95
        $this->basket->add('R01'); // 32.95
        $this->basket->add('R01'); // 32.95 / 2 = 16.475
        $this->basket->add('R01'); // 32.95 
        $this->basket->add('R01'); // 32.95 / 2 = 16.475
        /*
            // 2 x B01 = 2 * 7.95 = 15.90
            // 4 x R01: 
            //   First pair: 32.95 + (32.95 / 2) = 32.95 + 16.475 = 49.425
            //   Second pair: 32.95 + (32.95 / 2) = 32.95 + 16.475 = 49.425
            // Total: 15.90 + 49.425 + 49.425 = 114.75
        */
        $this->assertEquals(114.75, $this->basket->total());
    }


    public function testAddProductWithDelivery():void
    {
        $this->basket->add('B01'); // 7.95
        $this->basket->add('G01'); // 24.95
        // Total: 7.95 + 24.95 = 32.90, + 2.95 delivery cost due less than 50
        $this->assertEquals(37.85, $this->basket->total());
    }

    public function testAddProductWithOffer():void
    {
        $this->basket->add('R01'); // 32.95
        $this->basket->add('R01'); // 32.95 / 2 = 16.475
        // Total: 32.95 + 16.475 = 49.425, + 2.95 delivery cost due less than 90
        $this->assertEquals(54.37, $this->basket->total());
    }

    public function testEmptyBasketTotalIsZero(): void
    {
        $this->assertEquals(0.00, $this->basket->total());
    }

    public function testAddNonExistingProduct(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Product with code X01 does not exist in the catalogue');
        $this->basket->add('X01'); 
    }

    public function testAddMultipleSameProduct(): void
    {
        $this->basket->add('G01');
        $this->basket->add('G01');
        $this->basket->add('G01');
        $this->assertCount(3, $this->basket->getProducts());
        // 3 * 24.95 = 74.85, + 2.95 delivery cost due less than 90
        $this->assertEquals(77.8, $this->basket->total());
    }

    public function testAddAllProducts(): void
    {
        $this->basket->add('R01');
        $this->basket->add('G01');
        $this->basket->add('B01');
        $this->assertCount(3, $this->basket->getProducts());
        // 32.95 + 24.95 + 7.95 = 65.85, + 2.95 delivery cost due less than 90
        $this->assertEquals(68.8, $this->basket->total());
    }

    public function testOfferAppliedOnlyToDiscountedProduct(): void
    {
        $this->basket->add('R01'); //32.95
        $this->basket->add('R01'); //32.95/2 = 16.475
        $this->basket->add('G01'); //24.95
        // Total: 32.95 + 16.475 + 24.95 = 74.375, + 2.95 delivery cost due less than 90
        // total  is 77.325, rounded to 77.32
        $this->assertEquals(77.32, $this->basket->total());
    }

    public function testAddProductsWithNoOffer(): void
    {
        $this->basket->add('G01'); // 24.95
        $this->basket->add('B01'); // 7.95
        $this->basket->add('B01'); // 7.95
        // Total: 24.95 + 7.95 + 7.95 = 40.85, + 4.95 delivery cost due less than 50
        $this->assertEquals(45.8, $this->basket->total());
    }

    
}