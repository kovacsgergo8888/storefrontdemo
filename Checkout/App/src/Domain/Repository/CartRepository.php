<?php

namespace App\Domain\Repository;

use App\Domain\Cart;

interface CartRepository
{
    public function getCart(string $externalCartId): Cart;
}
