<?php

namespace App\WebshopBundle\Domain\Model\Checkout\Dto;

class ShippingMethod
{
    private string $shippingMethodId;
    private string $shippingMethodName;
    private float $shippingMethodFee;

    public function __construct(string $shippingMethodId, string $shippingMethodName, float $shippingMethodFee)
    {
        $this->shippingMethodId = $shippingMethodId;
        $this->shippingMethodName = $shippingMethodName;
        $this->shippingMethodFee = $shippingMethodFee;
    }

    public function getShippingMethodId(): string
    {
        return $this->shippingMethodId;
    }

    public function getShippingMethodName(): string
    {
        return $this->shippingMethodName;
    }

    public function getShippingMethodFee(): float
    {
        return $this->shippingMethodFee;
    }
}