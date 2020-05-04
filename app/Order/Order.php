<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    const STATE_CREATED = 'created';
    const STATE_PAID = 'paid';

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'orders_products',
            'order_id',
            'product_id'
        )->withPivot('quantity')
        ->withTimestamps();
    }

    public function addProduct(Product $product, float $quantity)
    {
        $this->products()->attach($product, ['quantity' => $quantity]);
    }

    public function removeProduct(Product $product)
    {
        $this->products()->detach($product);
    }

    public function getProduct(Product $product)
    {
        return $this->products()
            ->where('product_id', $product->getId())
            ->withPivot(['quantity'])
            ->get()->first();
    }

    public function user(): BelongsTo
    {
      return $this->belongsTo(User::class);
    }

    public function setUser(User $user)
    {
        $this->user()->associate($user);
    }

    public function getUser(): User
    {
        return $this->user()->get()->first();
    }

    public function getPrice(): float
    {
        return (float) $this->getAttribute('price');
    }

    public function setPrice(float $price)
    {
        $this->setAttribute('price', $price);
    }

    public function getState(): string
    {
        return $this->getAttribute('state');
    }

    public function setState(string $state)
    {
        if (
            $state !== self::STATE_PAID
            && $state !== self::STATE_CREATED
        ) {
            throw new \Exception('The given order state does not exists');
        }

        $this->setAttribute('state', $state);
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'state' => $this->getState(),
            'user' => $this->getUser(),
            'products' => $this->products()->get()->all(),
        ];
    }
}
