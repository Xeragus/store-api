<?php

namespace App\Http\Controllers;

use App\CompanyType;
use App\Repositories\Contracts\CompanyRepositoryInterface;
use App\User;
use Illuminate\Http\Request;
use App\Company\Commands\CreateCompanyFromDataCommand;
use App\Company\Commands\CreateCompanyCommand;

class CompaniesCreateController extends Controller
{
    public function create(Request $request, CompanyRepositoryInterface $companyRepository)
    {
        $data = $request->all();

        try {
//            $data['user_id'] = auth()->getUser()->getId();
//
//            dispatch_now(new CreateCompanyFromDataCommand($data));

//            $user = auth()->getUser();

            $user = User::find(1);
            $deliveryCompany = null;
            $deliveryCompanyId = (int)$request->get('delivery_company_id', 0);

            if ($deliveryCompanyId) {
                $deliveryCompany = $companyRepository->findOrFail($deliveryCompanyId);
            }

            $typeId = (int)$request->get('type_id', 0);

            $type = CompanyType::findOrFail($typeId);

            dispatch_now(new CreateCompanyCommand(
                $request->get('name'),
                $request->get('address'),
                $request->get('email'),
                $user,
                $type,
                $deliveryCompany
            ));
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
