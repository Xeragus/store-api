<?php

use App\Events\ProductWasCreated;
use App\Product;
use App\Repositories\Contracts\CompanyRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Request;


class ProductsController extends Controller
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
      $products = $this->productRepository->all();

      return response()->json($products);
    }
}