<?php


namespace App\Category\Commands;


use App\Category;
use App\Repostiories\Contracts\CategoriesRepositoryInterface;

class CreateCategoryFromData
{
    /**
     * @var array
     */
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle(CategoriesRepositoryInterface $categoriesRepository)
    {
        $category = new Category();

        $category->setName($this->data(['name']));
        $category->setDescription($this->data(['description']));

        $categoriesRepository->store($category);

    }


}
