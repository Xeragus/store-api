<?php

namespace App\Http\Controllers;

use App\Category;
use App\Events\CategoryWasCreated;
use App\Events\CategoryWasReallyCreated;
use App\Repostiories\Contracts\CategoriesRepositoryInterface;
use Illuminate\Http\Request;

class CategoriesCreateController extends Controller
{
    public function create(Request $request, CategoriesRepositoryInterface $categoriesRepository)
    {
        try {
            $category = new Category($request->all());

            $categoriesRepository->store($category);

            event(new CategoryWasCreated($category));
            event(new CategoryWasReallyCreated($category));

            return response()->json([
                'error' => false,
                'message' => 'the category has been successfully created with id #' . $category->id,
                'item' => $category
            ]);

        } catch (\Exception $e){
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }
}
