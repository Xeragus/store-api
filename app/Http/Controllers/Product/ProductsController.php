<?php

namespace App\Http\Controllers;

use App\Product;
//use App\Repositories\Contracts\CompanyRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
//use App\Repostiories\Contracts\CategoriesRepositoryInterface;
use Illuminate\Http\Request;
//use App\Product\Factories\ProductFactory;

class ProductsController extends Controller
{
    public function create(
        Request $request,
//        CompanyRepositoryInterface $companyRepository,
        ProductRepositoryInterface $productRepository
//        CategoriesRepositoryInterface $categoriesRepository,
//        ProductFactory $productFactory
    ) {
        try {
//            pred 2014
//            $companyId = (int)$request->get('company_id');
//            $categoryId = (int)$request->get('category_id');
//            $company = $companyRepository->findOrFail($companyId);
//            $category = $categoriesRepository->findOrFail($categoryId);
//            $product = $productFactory->make($request->all(), $company);

            $product = new Product($request->all());
            $productRepository->store($product);

//            pred 2014
//            $product->addCategory($category);
//            $productRepository->store($product);

        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }

        return response()->json([
            'error' => false,
            'message' => 'Product successfully created.'
        ]);
    }

    public function company(int $id, ProductRepositoryInterface $productRepository)
    {
        try {
            $product = $productRepository->get($id);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }

        return response()->json([
            'error' => false,
            'message' => 'Product\'s company is displayed.',
            'item' => $product->getCompany()
        ]);
    }

    public function delete(int $id, ProductRepositoryInterface $productRepository)
    {
        try {
            $product = $productRepository->findOrFail($id);

            $productRepository->delete($product);

            return response()->json([
                'error' => false,
                'message' => 'The product with id = ' . $id . ' has been successfully deleted'
            ]);
        } catch (\Exception $e){
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }
}
