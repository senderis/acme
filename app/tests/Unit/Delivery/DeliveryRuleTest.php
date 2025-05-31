<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Acme\Delivery\Rule\StandardDeliveryRule;
use Acme\Delivery\Rule\FreeDeliveryRule;
use Acme\Delivery\Rule\DeliveryPricing;

class DeliveryRuleTest extends TestCase
{
    public function testStandardDeliveryCost()
    {
        $rule = new StandardDeliveryRule();

        $this->assertEquals(DeliveryPricing::COST_STANDARD, $rule->calculateDeliveryCost(30));
        $this->assertEquals(DeliveryPricing::COST_REDUCED, $rule->calculateDeliveryCost(70));
        $this->assertEquals(DeliveryPricing::COST_FREE, $rule->calculateDeliveryCost(90));
    }

    public function testFreeDeliveryCost()
    {
        $rule = new FreeDeliveryRule();

        $this->assertEquals(DeliveryPricing::COST_FREE, $rule->calculateDeliveryCost(90));
        $this->assertEquals(DeliveryPricing::COST_FREE, $rule->calculateDeliveryCost(100));
    }
    
    public function testStandardDeliveryCostWithEdgeValues()
    {
        $rule = new StandardDeliveryRule();

        // Test just below reduced threshold
        $this->assertEquals(DeliveryPricing::COST_STANDARD, $rule->calculateDeliveryCost(49.99));
        // Test at reduced threshold
        $this->assertEquals(DeliveryPricing::COST_REDUCED, $rule->calculateDeliveryCost(50));
        // Test just below free threshold
        $this->assertEquals(DeliveryPricing::COST_REDUCED, $rule->calculateDeliveryCost(89.99));
        // Test at free threshold
        $this->assertEquals(DeliveryPricing::COST_FREE, $rule->calculateDeliveryCost(90));
        // Test above free threshold
        $this->assertEquals(DeliveryPricing::COST_FREE, $rule->calculateDeliveryCost(150));
    }


    public function testStandardDeliveryCostWithNegativeAndZero()
    {
        $rule = new StandardDeliveryRule();

        $this->assertEquals(DeliveryPricing::COST_STANDARD, $rule->calculateDeliveryCost(0));
        $this->assertEquals(DeliveryPricing::COST_STANDARD, $rule->calculateDeliveryCost(-10));
    }

    public function testFreeDeliveryCostWithNegativeAndZero()
    {
        $rule = new FreeDeliveryRule();

        $this->assertEquals(DeliveryPricing::COST_FREE, $rule->calculateDeliveryCost(0));
        $this->assertEquals(DeliveryPricing::COST_FREE, $rule->calculateDeliveryCost(-10));
    }
}