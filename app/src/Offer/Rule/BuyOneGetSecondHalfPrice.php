<?php

declare(strict_types=1);

namespace Acme\Offer\Rule;

use Acme\Offer\Interface\OfferStrategyInterface;
use Acme\Basket;

final class BuyOneGetSecondHalfPrice implements OfferStrategyInterface
{
    public function applyOffer(Basket $basket): float
    {
        $redWidgetCode = 'R01';
        $items = $basket->getProducts();
        $redWidgetCount = 0;

        foreach ($items as $item) {
            if ($item->getCode() === $redWidgetCode) {
                $redWidgetCount++;
            }
        }

        if ($redWidgetCount >= 2) {
            $discountedItems = floor($redWidgetCount / 2);
            // Find the price of the red widget from the first matching item
            $redWidgetPrice = null;
            foreach ($items as $item) {
                if ($item->getCode() === $redWidgetCode) {
                    $redWidgetPrice = $item->getPrice();
                    break;
                }
            }
            if ($redWidgetPrice !== null) {
                return $discountedItems * ($redWidgetPrice / 2);
            }
        }
        return 0.0; // No discount applicable
    }
}
