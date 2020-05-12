<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductUpdateController extends Controller
{
    public function update(
        int $id,
        Request $request,
        ProductRepositoryInterface $productRepository
    ) {
        try {
            $product = $productRepository->get($id);

            $product->fill($request->all());

            $productRepository->store($product);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }

        return response()->json([
            'error' => false,
            'message' => 'Product successfully updated.'
        ]);
    }
}
