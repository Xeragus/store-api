<?php


namespace App\Http\Controllers\Company;

use App\Repositories\Contracts\CompanyRepositoryInterface;
use Illuminate\Http\Request;

class CompaniesUpdateController
{
    public function update(int $id, CompanyRepositoryInterface $companyRepository, Request $request)
    {
        try{
            $company = $companyRepository->findOrFail($id);

            $data = $request->all();

            $company->setName($data['name']);
            $company->setAddress($data['address']);
            $company->setEmail($data['email']);

            $companyRepository->store($company);

            return response()->json([
                'error' => false,
                'message' => 'The company ,with id = ' . $id . ', had its information successfully updated'
            ]);
        } catch (\Exception $e){
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

}
