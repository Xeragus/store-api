<?php

namespace App\Order;

use App\Order;
use App\Repostiories\Contracts\OrderRepositoryInterface;
use App\User;

class CreateOrderCommand
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var float
     */
    private $price;

    /**
     * @var string
     */
    private $state;

    public function __construct(User $user, float $price = 0, string $state = Order::STATE_CREATED)
    {
        $this->user = $user;
        $this->price = $price;
        $this->state = $state;
    }

    public function handle(OrderRepositoryInterface $orderRepository)
    {
        $order = new Order();

        $order->setUser($this->user);
        $order->setPrice($this->price);
        $order->setState($this->state);

        $orderRepository->store($order);

        return $order;
    }
}
