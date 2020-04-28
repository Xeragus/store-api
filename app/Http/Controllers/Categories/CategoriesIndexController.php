<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repostiories\Contracts\CategoriesRepositoryInterface;

class CategoriesIndexController extends Controller
{
    public function index(CategoriesRepositoryInterface $categoriesRepository)
    {
        try{
            return response()->json([
                'error' => false,
                'message' => 'Here are all the categories',
                'item' => $categoriesRepository->all()
            ]);
        } catch (\Exception $e){
            return response()->json([
                'error' =>true,
                'message' => $e->getMessage()
            ]);
        }


    }
}
