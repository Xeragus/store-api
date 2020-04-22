<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(OrdersProductsTableSeeder::class);
        $this->call(LocationSeeder::class);

    }
}
