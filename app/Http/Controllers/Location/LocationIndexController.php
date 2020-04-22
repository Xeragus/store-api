<?php
namespace App\Http\Controllers;

use App\Repositories\Contracts\LocationRepositoryInterface;

class LocationIndexController extends Controller
{
    /**
     * @param LocationRepositoryInterface $locationRepository
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(LocationRepositoryInterface $locationRepository)
    {
        try {
            return response()->json([
                'error' => false,
                'message' => 'Here are all the locations in the database',
                'item' => $locationRepository->all()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }
}
