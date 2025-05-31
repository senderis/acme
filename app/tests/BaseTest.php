<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Acme\Catalogue;
use Acme\Product;
use Acme\Basket;
use Acme\Delivery\Rule\StandardDeliveryRule;
use Acme\Offer\Rule\BuyOneGetSecondHalfPrice;

abstract class BaseTest extends TestCase
{
    protected Basket $basket;
    
    protected function setUp(): void
    {
        $catalogue = new Catalogue([
            new Product('R01', 'Red Widget', 32.95),
            new Product('G01', 'Green Widget', 24.95),
            new Product('B01', 'Blue Widget', 7.95)
        ]);

        $deliveryRule = new StandardDeliveryRule();
        $offer = new BuyOneGetSecondHalfPrice('R01');

        $this->basket = new Basket($catalogue, $deliveryRule, $offer);
    }

}