<?php

namespace App\Http\Middleware;

use App\Repositories\Contracts\ProductRepositoryInterface;
use Closure;

class CheckProductOwnership
{
    private $productRepositoryInterface;

    public function __construct(ProductRepositoryInterface $productRepositoryInterface)
    {
        $this->productRepositoryInterface = $productRepositoryInterface;
    }

    public function handle($request, Closure $next)
    {
        $product = $this->productRepositoryInterface->get((int) $request->route('id'));

        if ($product->getCompany()->getUser()->getId() != auth()->getUser()->getId()) {
            return response(['message' => 'You are not authorized to complete this action'], 401);
        }

        return $next($request);
    }
}
