<?php

namespace App\Repositories;

use App\Location;
use App\Repositories\Contracts\LocationRepositoryInterface;

class EloquentLocationRepository implements LocationRepositoryInterface
{
    public function all(): array
    {
        return Location::all()->all();
    }

    public function store(Location $location)
    {
        $location->save();
    }

    public function get(int $id): ?Location
    {
        return Location::find($id);
    }

    public function findOrFail(int $id): ?Location
    {
        return Location::findOrFail($id);
    }

    public function delete(Location $location)
    {
        $location->delete();
    }
}

