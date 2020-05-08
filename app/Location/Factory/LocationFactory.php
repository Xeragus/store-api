<?php


namespace App\Location\Factory;


use App\Company;
use App\Location;

class LocationFactory
{
    public function make(array $data, Company $company)
    {
        $location = new Location();

        $location->setAddressNumber($data->get('address_number'));
        $location->setAddress($data->get('address'));
        $location->setEntry($data->get('entry'));
        $location->setCompany($company);

        return $location;
    }

}
