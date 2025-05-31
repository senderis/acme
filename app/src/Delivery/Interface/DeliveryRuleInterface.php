<?php

declare(strict_types=1);

namespace Acme\Delivery\Interface;

interface DeliveryRuleInterface
{
    public function calculateDeliveryCost(float $total): float;
}
