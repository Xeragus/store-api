<?php

namespace App\Repositories;

use App\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;

class EloquentProductRepository implements ProductRepositoryInterface
{
    public function all(): array
    {
        return Product::all()->all();
    }

    public function get(int $id): ?Product
    {
        return Product::find($id);
    }

    public function findOrFail(int $id): Product
    {
        return Product::findOrFail($id);
    }

    public function store(Product $product)
    {
        $product->save();
    }

    public function delete(Product $product)
    {
        $product->delete();
    }

    public function getByName(string $name): array
    {
        return Product::where('name', 'like', '%' . $name . '%')
            ->get()->all();
    }

    public function getByNameStrict(string $name): ?Product
    {
        return Product::where('name', $name)->get()->first();
    }
}
