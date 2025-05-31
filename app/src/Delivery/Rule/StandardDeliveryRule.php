<?php

declare(strict_types=1);

namespace Acme\Delivery\Rule;

use Acme\Delivery\Interface\DeliveryRuleInterface;
use Acme\Delivery\Rule\DeliveryPricing;

final class StandardDeliveryRule implements DeliveryRuleInterface
{
    public function calculateDeliveryCost(float $total): float
    {
        if ($total < DeliveryPricing::THRESHOLD_REDUCED) {
            return DeliveryPricing::COST_STANDARD;
        } elseif ($total < DeliveryPricing::THRESHOLD_FREE) {
            return DeliveryPricing::COST_REDUCED;
        } else {
            return DeliveryPricing::COST_FREE;
        }
    }
}
