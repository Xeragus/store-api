<?php

namespace App\Http\Controllers;

use App\Repostiories\Contracts\CategoriesRepositoryInterface;

class CategoriesShowController extends Controller
{
    public function show(int $id, CategoriesRepositoryInterface $categoriesRepository)
    {
        try{
            return response()->json([
                'error' => false,
                'message' => 'Here is the category with id #' . $id,
                'item' => $categoriesRepository->get($id)
            ]);
        }catch(\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }
}
