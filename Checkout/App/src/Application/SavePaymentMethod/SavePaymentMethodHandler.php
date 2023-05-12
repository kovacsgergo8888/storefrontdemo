<?php

namespace App\Application\SavePaymentMethod;


use App\Application\Exception\ApplicationException;
use App\Domain\Checkout;
use App\Domain\CheckoutRepositoryInterface;
use App\Domain\Repository\PaymentRepository;
use App\Domain\Shared\EntityId;

class SavePaymentMethodHandler
{
    public function __construct(
        private CheckoutRepositoryInterface $checkoutRepository,
        private PaymentRepository $paymentApi
    ){}

    public function __invoke(SavePaymentMethodCommand $command): Checkout
    {
        $checkout = $this->checkoutRepository->findCheckout(new EntityId($command->checkoutId));
        if ($checkout === null) {
            throw new ApplicationException('checkout not found');
        }

        $paymentMethod = $this->paymentApi->getPaymentMethod($command->externalPaymentMethodId);

        $checkout->setPaymentMethod($paymentMethod);
        $this->checkoutRepository->updateCheckout($checkout);
        return $checkout;
    }
}
