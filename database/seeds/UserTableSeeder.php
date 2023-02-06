<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'              => 'admin',
            'email'             => 'admin@gmail.com',
            'password'          => bcrypt('admin'),
            'id_rol'            => 1,
            'remember_token'    => Str::random(10),
        ]);

        setRoles([1],1);
    }
}
