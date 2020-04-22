<?php

use App\Events\ProductWasCreated;
use App\Product;
use App\Repositories\Contracts\CompanyRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Request;


class ProductsController extends Controller
{

	private $productRepository;

    

    public function getById(int $id)
    {
//        $product = Product::find($id);
        $product = $this->productRepository->get($id);

        return response()->json(['product' => $product]);
    }

}