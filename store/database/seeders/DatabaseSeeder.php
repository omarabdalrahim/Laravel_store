<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\product;
use App\Models\store;
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
        //  \App\Models\User::factory(10)->create();
        //  $this->call(UserSeeder::class);
         store::factory(5)->create();
         Category::factory(10)->create();
        product::factory(100)->create();
    }
}
