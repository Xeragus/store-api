<?php


namespace App\Repostiories;

use App\Category;
use App\Repostiories\Contracts\CategoriesRepositoryInterface;


class EloquentCategoryRepository implements CategoriesRepositoryInterface
{
    public function all(): array
    {
        return Category::all()->all();
    }

    public function store(Category $category)
    {
        $category->save();
    }

    public function delete(Category $category)
    {
        $category->delete();
    }

    public function get(int $id) : ?Category
    {
        return Category::find($id);
    }

    public function findOrFail(int $id) : Category
    {
        return Category::findOrFail($id);
    }

}
