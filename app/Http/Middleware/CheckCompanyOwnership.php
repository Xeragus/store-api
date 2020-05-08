<?php

namespace App\Http\Middleware;

use App\Repositories\Contracts\CompanyRepositoryInterface;
use Closure;

class CheckCompanyOwnership
{
    private $companyRepositoryInterface;

    public function __construct(CompanyRepositoryInterface $companyRepositoryInterface)
    {
        $this->companyRepositoryInterface = $companyRepositoryInterface;
    }

    public function handle($request, Closure $next)
    {
        $company = $this->companyRepositoryInterface->get((int) $request->route('id'));

        if ($company->getUser()->getId() != auth()->getUser()->getId()) {
            return response(['message' => 'You are not authorized to complete this action'], 401);
        }

        return $next($request);
    }
}
