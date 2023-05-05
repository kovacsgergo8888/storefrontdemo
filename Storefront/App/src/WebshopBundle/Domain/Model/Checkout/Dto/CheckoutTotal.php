<?php

namespace App\WebshopBundle\Domain\Model\Checkout\Dto;

class CheckoutTotal
{
    private float $value;
    private string $currency;

    public function __construct(float $value, string $currency)
    {
        $this->value = $value;
        $this->currency = $currency;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

}