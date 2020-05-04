<?php


namespace App\Repostiories\Contracts;

use App\Category;


interface CategoriesRepositoryInterface
{
    public function all(): array;

    public function store(Category $category);

    public function get(int $id): ?Category;

    public function findOrFail(int $id): ?Category;

    public function delete(Category $category);
}
