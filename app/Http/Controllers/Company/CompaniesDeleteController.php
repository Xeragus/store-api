<?php


namespace App\Http\Controllers\Company;


use App\Repositories\Contracts\CompanyRepositoryInterface;
use Illuminate\Http\Request;

class CompaniesDeleteController
{
    public function delete(int $id, CompanyRepositoryInterface $companyRepository)
    {
        try{
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
