<?php

declare(strict_types=1);

namespace Acme\Delivery\Rule;

use Acme\Delivery\Interface\DeliveryRuleInterface;

final class FreeDeliveryRule implements DeliveryRuleInterface
{
    public function calculateDeliveryCost(float $total): float
    {
        return 0.00;
    }
}
