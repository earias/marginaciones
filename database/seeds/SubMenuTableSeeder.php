<?php

use Illuminate\Database\Seeder;

class SubMenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // menu para menu
        DB::table('sub_menu')->insert([
            'id'            => 1,
            'title' 	 	=> 'Menu',
            'description' 	=> 'listado de menu',
            'url' 			=> "menu",
            'icon' 		    =>  "bx bx-list-ul",
            'id_menu'		=> 1,
            'order'         => 2
        ]);
      
        // menu de roles
        DB::table('sub_menu')->insert([
            'id'            => 2,
            'title'         => 'Roles',
            'description'   => 'Lista de roles',
            'url'           => "rol",
            'icon'          => "bx bx-id-card",
            'id_menu'       => 1,
            'order'         => 3
        ]);       

        // menu de usuarios
        DB::table('sub_menu')->insert([
            'id'            => 3,
            'title'         => 'Usuario',
            'description'   => 'Lista de usuarios',
            'url'           => "usuario",
            'icon'          => "bx bx-user-circle",
            'id_menu'       => 1,
            'order'         => 4
        ]);

        DB::table('sub_menu')->insert([
            'id'            => 4,
            'title'         => 'Periodo',
            'description'   => 'Lista de periodos',
            'url'           => "periodo",
            'icon'          => "bx bx-user-circle",
            'id_menu'       => 1,
            'order'         => 4
        ]);

        
    }
}
