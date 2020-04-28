<?php

namespace App\Events;

use App\Category;

class CategoryWasCreated
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getCategory()
    {
        return $this->category;
    }
}
