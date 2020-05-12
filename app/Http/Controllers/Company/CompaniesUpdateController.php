<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\CompanyRepositoryInterface;
use Illuminate\Http\Request;

class CompaniesUpdateController extends Controller
{
    public function update(int $id, CompanyRepositoryInterface $companyRepository, Request $request)
    {
        try {
            $company = $companyRepository->findOrFail($id);
            $company->fill($request->all());
            $companyRepository->store($company);

            return response()->json([
                'error' => false,
                'message' => 'The company with id = ' . $id . ', had its information successfully updated'
            ]);
        } catch (\Exception $e){
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }
}
