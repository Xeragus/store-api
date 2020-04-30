<?php

namespace App\Http\Controllers;

use App\Events\LocationWasAdded;
use App\Repositories\Contracts\CompanyRepositoryInterface;
use App\Repositories\Contracts\LocationRepositoryInterface;
use Illuminate\Http\Request;
use App\Location;
use Exception;

class LocationCreateController extends Controller
{
    public function create(
        Request $request,
        LocationRepositoryInterface $locationRepository,
        CompanyRepositoryInterface $companyRepository
    ) {
        try {
            $companyId = (int)$request->get('company_id');
            $company = $companyRepository->findOrFail($companyId);

            $location = new Location();

            $location->setAddressNumber($request->get('address_number'));
            $location->setAddress($request->get('address'));
            $location->setEntry($request->get('entry'));
            $location->setCompany($company);

            $locationRepository->store($location);

            event(new LocationWasAdded($location));

            return response()->json([
                'error' => false,
                'message' => 'New location has been added with id #' . $location->id,
                'item' => $location
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }

    }
}

