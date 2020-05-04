<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\CompanyRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Company;
use App\Company\Commands\CreateCompanyFromDataCommand;
use App\Company\Commands\CreateCompanyCommand;

class CompaniesCreateController extends Controller
{
    public function create(Request $request, CompanyRepositoryInterface $companyRepository)
    {
        try {
   
            dispatch_now(new CreateCompanyFromDataCommand($request->all()));

        } catch (\Exception $e) {
            return response()->json([
              'error' => true,
              'message' => $e->getMessage()
            ]);
        }

        return response()->json([
            'error' => false,
            'message' => 'The company is successfully stored'
        ]);
    }
}
