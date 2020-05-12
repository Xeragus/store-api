<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\CompanyRepositoryInterface;

class CompaniesDeleteController extends Controller
{
    public function delete(int $id, CompanyRepositoryInterface $companyRepository)
    {
        try {
            $company = $companyRepository->findOrFail($id);

            $companyRepository->delete($company);

            return response()->json([
                'error' => false,
                'message' => 'The company with id = ' . $id . ' has been successfully deleted'
            ]);
        } catch (\Exception $e){
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

}
