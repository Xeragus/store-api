<?php

namespace App\Events;

use App\Location;

class LocationWasDeleted
{
    private $location;

    public function __construct(Location $location)
    {
        $this->location = $location;
    }

    public function getLocation()
    {
        return $this->location;
    }
}
