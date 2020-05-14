<?php

use App\CompanyType;
use Illuminate\Database\Seeder;

class CompanyTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = new CompanyType();
        $type->setName('Delivery');
        $type->setCode('delivery');
        $type->save();

        $type = new CompanyType();
        $type->setName('Not Delivery');
        $type->setCode('not-delivery');
        $type->save();
    }
}
