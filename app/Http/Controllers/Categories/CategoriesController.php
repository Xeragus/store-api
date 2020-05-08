<?php


namespace App\Http\Controllers\Categories;


use App\Category\Commands\CreateCategoryFromData;
use App\Category\Factories\CategoryFactory;
use App\Events\CategoryWasReallyCreated;
use App\Repostiories\Contracts\CategoriesRepositoryInterface;
use Illuminate\Http\Request;

class CategoriesController
{
    public function create(
        Request $request,
        CategoriesRepositoryInterface $categoriesRepository,
        CategoryFactory $categoryFactory
    )
    {
        try {

            $category = $categoryFactory->make($request->all());

            $categoriesRepository->store($category);

            event(new CategoryWasReallyCreated($category));

            return response()->json([
                'error' => false,
                'message' => 'The category has been successfully created with id #' . $category->id,
                'item' => $category
            ]);

        } catch (\Exception $e){
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function delete(int $id, CategoriesRepositoryInterface $categoriesRepository)
    {
        try{

            $category = $categoriesRepository->findOrFail($id);

            $categoriesRepository->delete($category);

            return response()->json([
              'error' => false,
              'message' => 'The category with id = ' . $id . 'has been deleted'
            ]);
        } catch (\Exception $e){
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

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
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function show(CategoriesRepositoryInterface $categoriesRepository, int $id)
    {
        try{
            return response()->json([
                'error' => false,
                'message' => 'Here is the specific category with id = ' . $id,
                'item' => $categoriesRepository->findOrFail($id)
                ]);
        } catch (\Exception $e){
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

}
