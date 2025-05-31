<?php

declare(strict_types=1);

use BaseTest;
use Acme\Offer\Rule\BuyOneGetSecondHalfPrice;

class BuyOneGetSecondHalfPriceTest extends BaseTest
{

    public function testNoRedWidgetsNoDiscount(): void
    {
        $this->basket->add('G01');
        $this->basket->add('B01');
        $offer = new BuyOneGetSecondHalfPrice();
        $discount = $offer->applyOffer($this->basket);
        $this->assertEquals(0.0, $discount);
    }

    public function testOneRedWidgetNoDiscount(): void
    {
        $this->basket->add('R01');
        $offer = new BuyOneGetSecondHalfPrice();
        $discount = $offer->applyOffer($this->basket);
        $this->assertEquals(0.0, $discount);
    }

    public function testTwoRedWidgetsOneDiscount(): void
    {
        $this->basket->add('R01');
        $this->basket->add('R01');
        $offer = new BuyOneGetSecondHalfPrice();
        $discount = $offer->applyOffer($this->basket);
        $this->assertEquals(16.475, $discount);
    }

    public function testThreeRedWidgetsOneDiscount(): void
    {
        $this->basket->add('R01');
        $this->basket->add('R01');
        $this->basket->add('R01');
        $offer = new BuyOneGetSecondHalfPrice();
        $discount = $offer->applyOffer($this->basket);
        $this->assertEquals(16.475, $discount);
    }

    public function testFourRedWidgetsTwoDiscounts(): void
    {
        $this->basket->add('R01');
        $this->basket->add('R01');
        $this->basket->add('R01');
        $this->basket->add('R01');
        $offer = new BuyOneGetSecondHalfPrice();
        $discount = $offer->applyOffer($this->basket);
        $this->assertEquals(32.95, $discount);
    }

    public function testMixedProductsWithRedWidgets(): void
    {
        $this->basket->add('R01');
        $this->basket->add('G01');
        $this->basket->add('R01');
        $this->basket->add('B01');
        $offer = new BuyOneGetSecondHalfPrice();
        $discount = $offer->applyOffer($this->basket);
        $this->assertEquals(16.475, $discount);
    }
}
