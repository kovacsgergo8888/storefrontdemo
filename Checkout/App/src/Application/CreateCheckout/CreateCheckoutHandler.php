<?php

namespace App\Application\CreateCheckout;

use App\Domain\Checkout;
use App\Domain\CheckoutRepositoryInterface;
use App\Domain\CheckoutStatus;
use App\Domain\Repository\CartRepository;
use App\Domain\Shared\EntityIdGeneratorInterface;

class CreateCheckoutHandler
{
    public function __construct(
        private EntityIdGeneratorInterface $entityIdGenerator,
        private CheckoutRepositoryInterface $checkoutRepository,
        private CartRepository $cartApi
    ) {
    }

    public function __invoke(CreateCheckoutCommand $command): Checkout
    {
        $checkoutId = $this->entityIdGenerator->generate();
        $cart = $this->cartApi->getCart($command->cartId);
        $checkout = new Checkout(
            $checkoutId,
            CheckoutStatus::Pending,
            $cart
        );
        $this->checkoutRepository->createCheckout($checkout);
        return $checkout;
    }
}
