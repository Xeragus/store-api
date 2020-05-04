<?php


namespace App\Category\Factories;


use App\Category;

class CategoryFactory
{
    public function make(array $data)
    {
        $category = new Category();

        $category->setName($this->data(['name']));
        $category->setDescription($this->data(['description']));

        return $category;

    }

}
