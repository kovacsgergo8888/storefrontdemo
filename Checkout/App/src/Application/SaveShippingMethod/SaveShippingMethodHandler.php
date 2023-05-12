<?php

namespace App\Application\SaveShippingMethod;

use App\Application\Exception\ApplicationException;
use App\Domain\Checkout;
use App\Domain\CheckoutRepositoryInterface;
use App\Domain\Repository\ShippingRepository;
use App\Domain\Shared\EntityId;

class SaveShippingMethodHandler
{
    public function __construct(
        private CheckoutRepositoryInterface $checkoutRepository,
        private ShippingRepository $shippingApi
    ){}

    public function __invoke(SaveShippingMethodCommand $command): Checkout
    {
        $checkout = $this->checkoutRepository->findCheckout(new EntityId($command->checkoutId));
        if ($checkout === null) {
            throw new ApplicationException('checkout not found');
        }

        $shippingMethod = $this->shippingApi->getShippingMethod($command->externalShippingMethodId);

        $checkout->setShippingMethod($shippingMethod);
        $this->checkoutRepository->updateCheckout($checkout);
        return $checkout;
    }
}
