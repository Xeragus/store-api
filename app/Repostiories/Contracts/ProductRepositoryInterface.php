<?php

namespace App\Repositories\Contracts;

use App\Product;

interface ProductRepositoryInterface
{
    public function all(): array;

    public function get(int $id): ?Product;

    public function findOrFail(int $id): Product;

    public function store(Product $product);

    public function delete(Product $product);

    public function getByName(string $name): array;

    public function getByNameStrict(string $name): ?Product;
}
