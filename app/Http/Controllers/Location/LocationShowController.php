<?php
namespace App\Http\Controllers;

use App\Repositories\Contracts\LocationRepositoryInterface;

class LocationShowController extends Controller
{
    public function show(int $id, LocationRepositoryInterface $locationRepository)
    {
        try {
            return response()->json([
                'error' => false,
                'message' => 'We found your address with id #' . $id,
                'item' => $locationRepository->get($id)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }

    }
}
