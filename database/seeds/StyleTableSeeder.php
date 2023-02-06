<?php

use Illuminate\Database\Seeder;

class StyleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('style')->insert([
        	'title' 	=> 'Dark',
            'style'  	=> 'vertical-layout vertical-menu-modern dark-layout content-left-sidebar chat-application navbar-sticky footer-static'
        ]);
        DB::table('style')->insert([
        	'title' 	=> 'Semi-dark',
            'style'  	=> 'vertical-layout vertical-menu-modern semi-dark-layout 2-columns calendar-application navbar-sticky footer-static'
        ]);
        DB::table('style')->insert([
        	'title' 	=> 'lite',
            'style'  	=> 'vertical-layout vertical-menu-modern content-left-sidebar chat-application navbar-sticky footer-static'
        ]);
    }
}
