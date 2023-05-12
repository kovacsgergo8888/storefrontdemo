<?php

namespace App\Infrastructure\Adapter\CartApi;

use App\Domain\Cart;
use App\Domain\CartItem;
use App\Domain\Repository\CartRepository;
use App\Domain\Shared\EntityIdGeneratorInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CartApi implements CartRepository
{


    public function __construct(
        private HttpClientInterface $client,
        private EntityIdGeneratorInterface $entityIdGenerator
    ) {
        $this->client = $client->withOptions([
            'base_uri' => 'http://api_gateway_nginx:8080'
        ]);
    }

    public function getCart(string $externalCartId): Cart
    {
        $response = $this->client->request('GET', "/cart/api/carts/$externalCartId");
        $data = json_decode($response->getContent(), true);

        $cart = new Cart(
            $this->entityIdGenerator->generate(),
            $data['id'],
            $data['total']
        );

        foreach ($data['items'] as $item) {
            $cart->addCartItem(new CartItem(
                $this->entityIdGenerator->generate(),
                $item['id'],
                $item['sku'],
                'some productn name',
                $item['quantity'],
                $item['price'],
                $item['total'],
                $cart
            ));
        }

        return $cart;
    }
}
