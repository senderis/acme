<?php

declare(strict_types=1);

namespace Acme\Delivery\Rule;

final class DeliveryPricing
{
    public const THRESHOLD_FREE = 90.00;
    public const THRESHOLD_REDUCED = 50.00;
    public const COST_STANDARD = 4.95;
    public const COST_REDUCED = 2.95;
    public const COST_FREE = 0.00;
}
