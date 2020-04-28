<?php

namespace App\Events;

use App\Category;

class CategoryWasReallyCreated
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }
}
