<?php

namespace App\Repostiories\Contracts;

use App\Order;
use App\User;

interface OrderRepositoryInterface
{
    public function get(int $id): ?Order;

    public function store(Order $order);

    public function getByUser(User $user, string $state): ?Order;
}
