<?php

namespace App\Domain\Repository;

use App\Domain\PaymentMethod;

interface PaymentRepository
{
    public function getPaymentMethod(string $externalPaymentMethodId): PaymentMethod;
}
