<?php

use Illuminate\Database\Seeder;
use App\Company;
use App\Location;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company = Company::where('name', 'Filip DOOEL')->first();

        $location = new Location();

        $location->setCompany($company);
        $location->setAddress('Skopje, Kaposh');
        $location->setAddressNumber("54");
        $location->setEntry('2');

        $location->save();
    }
}
