<?php

declare(strict_types=1);

namespace Acme;

final class Product
{
    public function __construct(private string $code, private string $name, private float $price)
    {
        $this->code = $code;
        $this->name = $name;
        $this->price = $price;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}
