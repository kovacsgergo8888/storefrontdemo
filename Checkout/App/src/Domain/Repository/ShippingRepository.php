<?php

namespace App\Domain\Repository;

use App\Domain\ShippingMethod;

interface ShippingRepository
{
    public function getShippingMethod(string $externalShippingMethodId): ShippingMethod;
}
