<?php

use Illuminate\Database\Seeder;

class RolAccesosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Accesos para super administrador
        DB::table('rol_accesos')->insert(['id_rol' => 1, 'id_submenu' => 1]);
        DB::table('rol_accesos')->insert(['id_rol' => 1, 'id_submenu' => 2]);
        DB::table('rol_accesos')->insert(['id_rol' => 1, 'id_submenu' => 3]);
        DB::table('rol_accesos')->insert(['id_rol' => 1, 'id_submenu' => 4]);
       
    }
}
