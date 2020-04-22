<?php

namespace App\Http\Controllers;

use App\Events\ProductWasCreated;
use App\Product;
use App\Repositories\Contracts\CompanyRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Request;


class ProductsController extends Controller
{
	private $productRepository;

    

    public function getByName(Request $request)
    {
        $name = $request->get('name', '');

        $products = $this->productRepository->getByName($name);

        return response()->json($products);
    }
}