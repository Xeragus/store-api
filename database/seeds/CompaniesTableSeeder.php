<?php

use Illuminate\Database\Seeder;
use App\Company;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company = new Company();

        $company->name = 'Filip DOOEL';
        $company->address = 'Blagoj Davkov';
        $company->email = 'filip@email.com';


        $company->save();
    }
}
