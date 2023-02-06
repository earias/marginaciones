<?php

use Illuminate\Database\Seeder;

class RolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rol')->insert([
            'title'         => 'super administrador',
            'Description'   => 'Control total del sistema',
            'create'        => 1,
            'show'          => 1,
            'cancel'        => 1,
            'edit'          => 1,
            'delete'        => 1
        ]);

        DB::table('rol')->insert([
            'title'        => 'administrador',
            'Description'   => 'control intermedio del sistema',
            'create'        => 1,
            'show'          => 1,
            'edit'          => 1,
            'delete'        => 0
        ]);

        DB::table('rol')->insert([
            'title'        => 'Invitado',
            'Description'   => 'control basico del sistema',
            'create'        => 0,
            'show'          => 1,
            'edit'          => 0,
            'delete'        => 0
        ]);
    }
}
