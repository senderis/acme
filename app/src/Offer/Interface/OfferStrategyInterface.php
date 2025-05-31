<?php

declare(strict_types=1);

namespace Acme\Offer\Interface;

use Acme\Basket;

interface OfferStrategyInterface
{
    public function applyOffer(Basket $basket): float;
}
