<?php

use Illuminate\Database\Seeder;

class StyleMenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('style_menu')->insert([
        	'title' 	=> 'Primary',
            'sub'       => 'primary',
            'style'  	=> '90, 141, 238'
        ]);
        DB::table('style_menu')->insert([
        	'title' 	=> 'Success',
            'sub'       => 'success',
            'style'  	=> '57, 218, 138'
        ]);
        DB::table('style_menu')->insert([
        	'title' 	=> 'Danger',
            'sub'       => 'danger',
            'style'  	=> '255, 91, 92'
        ]);
        DB::table('style_menu')->insert([
        	'title' 	=> 'Secundary',
            'sub'       => 'info',
            'style'  	=> '0, 207, 221'
        ]);
        DB::table('style_menu')->insert([
        	'title' 	=> 'Warning',
            'sub'       => 'warning',
            'style'  	=> '253, 172, 65'
        ]);
        DB::table('style_menu')->insert([
        	'title' 	=> 'Dark',
            'sub'       => 'dark',
            'style'  	=> '57, 76, 98'
        ]);
    }
}
