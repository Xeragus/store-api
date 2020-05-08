<?php

namespace App\Http\Controllers;

use App\Events\LocationWasAdded;
use App\Repositories\Contracts\CompanyRepositoryInterface;
use App\Repositories\Contracts\LocationRepositoryInterface;
use Illuminate\Http\Request;
use App\Location;
use Exception;
use App\Location\Factory\LocationFactory;

class LocationController extends Controller
{
    public function create(
        Request $request,
        LocationRepositoryInterface $locationRepository,
        CompanyRepositoryInterface $companyRepository,
        LocationFactory $locationFactory
    )
    {
        try {
            $companyId = (int)$request->get('company_id');
            $company = $companyRepository->findOrFail($companyId);

            $location = $locationFactory->make($request->all(), $company);

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

    public function delete(int $id, LocationRepositoryInterface $locationRepository)
    {
        try {
            $location = $locationRepository->findOrFail($id);

            $locationRepository->delete($location);

            return response()->json([
                'error' => false,
                'message' => 'The location with id = ' . $id . 'has been deleted'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function index(LocationRepositoryInterface $locationRepository)
    {
        try {
            return response()->json([
                'error' => false,
                'message' => 'Here are all the recorded locations',
                'item' => $locationRepository->all()
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function show(LocationRepositoryInterface $locationRepository, int $id)
    {
        try {
            return response()->json([
                'error' => false,
                'message' => 'Here is the location with id = ' . $id,
                'item' => $locationRepository->findOrFail($id)
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }
}

