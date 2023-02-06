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
        $this->call([
            StyleTableSeeder::class,
            StyleMenuTableSeeder::class,
            RolTableSeeder::class,
        	UserTableSeeder::class,
            MenuTableSeeder::class,
            SubMenuTableSeeder::class,
            RolAccesosSeeder::class
        ]);
    }
}
