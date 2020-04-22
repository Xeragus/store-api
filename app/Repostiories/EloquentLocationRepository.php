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
        return Location::findOrFail($id);
    }

    public function delete(Location $location)
    {
        $location->delete();
    }

    public function getByAddress(string $address): array
    {
        return Location::where('address', 'like' ,'%' . $address . '%')
            ->get()->all();
    }

    public function getByNumber(int $num): array
    {
        return Location::where('address number', 'like', '%' . $num . '%')
            ->get()->all();
    }

    public function getByCorrectAddress(string $address): array
    {
        return Location::where('address', $address)->get()->first();
    }
}

