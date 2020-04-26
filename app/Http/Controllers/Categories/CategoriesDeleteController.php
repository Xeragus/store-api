<?php

namespace App\Http\Controllers;

use App\Category;
use App\Repostiories\Contracts\CategoriesRepositoryInterface;
use Illuminate\Http\Request;

class CategoriesDeleteController extends Controller
{
    public function delete(int $id, CategoriesRepositoryInterface $categoriesRepository)
    {
        try {
            $category = $categoriesRepository->get($id);

            $categoriesRepository->delete($category);

            return response()->json([
                'error' => false,
                'message' => 'The category with id #' . $id . ' has been deleted'
            ]);
        }catch (\Exception $e){
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }
}
