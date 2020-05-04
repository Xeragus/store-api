<?php

namespace App\Order;

use App\Order;
use App\Product;
use App\Repostiories\Contracts\OrderRepositoryInterface;

class AddProductToOrderCommand
{
    /**
     * @var Order
     */
    private $order;

    /**
     * @var Product
     */
    private $product;

    /**
     * @var float
     */
    private $quantity;

    public function __construct(Order $order, Product $product, float $quantity)
    {
        $this->order = $order;
        $this->product = $product;
        $this->quantity = $quantity;
    }

    public function handle(OrderRepositoryInterface $orderRepository)
    {
        $this->order->addProduct($this->product, $this->quantity);

        $currentPrice = $this->order->getPrice();
        $this->order->setPrice($currentPrice + $this->product->getPrice() * $this->quantity);

        $orderRepository->store($this->order);
    }
}
