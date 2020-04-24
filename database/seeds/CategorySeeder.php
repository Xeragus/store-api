<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category1 = new Category(['name' => 'Domakjinstvo', 'description' => 'Najdobrite ponudi']);
        $category2 = new Category(['name' => 'Bela Tehnika', 'description' => 'tehnika tehnika']);
        $category1->save();
        $category2->save();
    }
}
