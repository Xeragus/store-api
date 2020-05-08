<?php

namespace App\Repositories\Contracts;

use App\Location;

interface LocationRepositoryInterface
{
    public function all() : array;

    public function store(Location $location);

    public function get(int $id) : ?Location;

    public function findOrFail(int $id) : ?Location;

    public function delete(Location $location);

}
