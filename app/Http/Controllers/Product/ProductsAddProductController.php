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
    private $productRepository;

    public function addProduct(Request $request, CompanyRepositoryInterface $companyRepository)
    {
        $product = new Product();

        $companyId = $request->get('company_id');
        $company = $companyRepository->get($companyId);

        if (!$company) {
            return response(['Company does not exist.']);
        }

        $price = (float) $request->get('price');

        $product->setName($request->get('name'));
        $product->setDescription($request->get('description'));
        $product->setCompany($company);
        $product->setPrice($price);

        $this->productRepository->store($product);

        event(new ProductWasCreated($product));

        return response()->json(['Product successfully stored.']);
    }

}