<?php

declare(strict_types=1);

namespace Acme;

use Acme\Delivery\Interface\DeliveryRuleInterface;
use Acme\Offer\Interface\OfferStrategyInterface;
use Acme\Product;
use Acme\Catalogue;

final class Basket
{
    /**
     * This is mandatory to avoid phpstan error
     * @var array<Product>
     **/
    private array $products = [];
    private int $discount = 0;

    private const ROUND_METHOD = PHP_ROUND_HALF_DOWN;
    private const ROUND_PRECISION = 2;

    public function __construct(
        private Catalogue $catalogue,
        private DeliveryRuleInterface $deliveryRule,
        private OfferStrategyInterface $offerStrategy
    ) {
        $this->catalogue = $catalogue;
        $this->deliveryRule = $deliveryRule;
        $this->offerStrategy = $offerStrategy;
    }

    public function add(string $productCode): void
    {
        $product = $this->catalogue->getProductByCode($productCode);
        if (!$product) {
            throw new \InvalidArgumentException("Product with code {$productCode} does not exist in the catalogue.");
        }

        $this->products[] = $product;
    }

    public function total(): float
    {
        //if there are no products, return 0.0
        if (empty($this->products)) {
            return 0.0;
        }
        $subtotal = array_reduce($this->products, function (float $carry, Product $product) {
            return $carry + $product->getPrice();
        }, 0);

        $offerDiscount = $this->offerStrategy->applyOffer($this);
        $totalWithOffers = $subtotal - $offerDiscount;

        $deliveryCost = $this->deliveryRule->calculateDeliveryCost($totalWithOffers);

        return round($totalWithOffers + $deliveryCost, self::ROUND_PRECISION, self::ROUND_METHOD);
    }

    public function getTotal(): float
    {
        $retValue = array_reduce($this->products, function ($total, $product) {
            return $total + $product->getPrice();
        }, 0) - $this->discount;

        return round($retValue, self::ROUND_PRECISION, self::ROUND_METHOD);
    }

    /**
    * @return array<Product>
    **/
    public function getProducts(): array
    {
        return $this->products;
    }
}
