<?php

use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu')->insert([
            'title' 		=> 'Configuraciones',
            'description' 	=> 'Seccion para configurar el menu y submenu',
            'url' 			=> "---",
            'icon'  		=> "bx bx-cog",
        ]);
    }
}
