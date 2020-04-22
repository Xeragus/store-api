<?php

namespace App\Http\Controllers;

use App\Events\ProductWasCreated;
use App\Product;
use App\Repositories\Contracts\CompanyRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Request;
// celiot controller da se refaktorira vo povekje kontroleri so 1 public endpoint
class ProductsController extends Controller
{
    /**
     * @var ProductRepositoryInterface
     */
    

    public function delete(int $id)
    {
        // da se refaktorira so find or fail
        $product = $this->productRepository->get($id);

        if (!$product) {
            return response()->json(['The product with the given id does not exist.']);
        }

        $this->productRepository->delete($product);

        return response()->json(['Product successfully deleted.']);
    }
}