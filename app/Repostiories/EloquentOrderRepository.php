<?php

namespace App\Repostiories;

use App\Order;
use App\Repostiories\Contracts\OrderRepositoryInterface;
use App\User;

class EloquentOrderRepository implements OrderRepositoryInterface
{
    public function get(int $id): ?Order
    {
        return Order::find($id);
    }

    public function store(Order $order)
    {
        $order->save();
    }

    public function getByUser(User $user, string $state): ?Order
    {
        return Order::where('user_id', $user->getId())
            ->where('state', $state)
            ->get()->first();
    }
}
