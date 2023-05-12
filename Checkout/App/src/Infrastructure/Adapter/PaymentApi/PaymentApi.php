<?php

namespace App\Infrastructure\Adapter\PaymentApi;


use App\Domain\PaymentMethod;
use App\Domain\Repository\PaymentRepository;
use App\Domain\Shared\EntityIdGeneratorInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PaymentApi implements PaymentRepository
{
    public function __construct(
        private HttpClientInterface $client,
        private EntityIdGeneratorInterface $entityIdGenerator
    ) {
        $this->client = $client->withOptions([
            'base_uri' => 'http://api_gateway_nginx:8080'
        ]);
    }

    public function getPaymentMethod(string $externalPaymentMethodId): PaymentMethod
    {
        $response = $this->client->request('GET', "/payment/api/paymentMethod/list/$externalPaymentMethodId");
        $data = json_decode($response->getContent(), true);
        return new PaymentMethod(
            $this->entityIdGenerator->generate(),
            $externalPaymentMethodId,
            $data['name'],
            $data['cost']
        );
    }
}
