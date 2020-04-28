<?php

namespace App\Http\Controllers;

use App\Events\LocationWasDeleted;
use App\Repositories\Contracts\LocationRepositoryInterface;

class LocationDeleteController extends Controller
{
    public function delete(int $id, LocationRepositoryInterface $locationRepository)
    {
        try {
            $location = $locationRepository->get($id);

            $locationRepository->delete($location);

            event(new LocationWasDeleted($location));

            return response()->json([
                'error' => false,
                'message' => 'Location is deleted'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

}
