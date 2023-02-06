<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	// return view('welcome');
	return redirect('/login');
});

Route::get('/marginaciones',  'MarginacionesController@index');
Route::get('/marginaciones/find',  'MarginacionesController@find')->name('marginaciones.find');
Route::get('/marginaciones/reporte',  'MarginacionesController@reporte')->name('marginaciones.reporte');

	Route::get('/file-import-export', 'MarginacionesController@fileImportExport')->name('file-import-export');;
	Route::post('/file-import',  'MarginacionesController@fileImport')->name('file-import');
	Route::get('/file-export',  'MarginacionesController@fileExport')->name('file-export');

// Auth::routes();

Route::get('/marginaciones', 'MarginacionesController@index');
Route::get('/marginaciones/find', 'MarginacionesController@find')->name('marginaciones.find');
Route::get('/marginaciones/reporte', 'MarginacionesController@reporte')->name('marginaciones.reporte');

Route::get('/importar', 'MarginacionesController@importar')->name('importar');;
Route::post('/file-import',  'MarginacionesController@fileImport')->name('file-import');
Route::get('/file-export',  'MarginacionesController@fileExport')->name('file-export');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

// 
Route::get('/perfil', 'UserController@show')->name('usuario.perfil');
Route::put('/update_pass', 'UserController@update_pass')->name('usuario.update_pass');
Route::put('/update_avatar/{id}', 'UserController@update_avatar')->name('usuario.update_avatar');
Route::put('/update_perfil/{id}', 'UserController@update_perfil')->name('usuario.update_perfil');

Route::group(['middleware' => 'accesos'], function () {

	Route::group(['prefix' => 'menu'], function () {
		Route::get('/', 'MenuController@index')->name('menu');
		Route::get('/find', 'MenuController@find')->name('menu.find');
		Route::post('/create', 'MenuController@store')->name('menu.create');
		Route::get('/edit/{menu}', 'MenuController@edit')->name('menu.edit');
		Route::put('/update/{menu}', 'MenuController@update')->name('menu.update');
		Route::get('/anular/{menu}', 'MenuController@anular')->name('menu.anular');
		Route::get('/activar/{menu}', 'MenuController@activar')->name('menu.activar');
		Route::get('/delete/{menu}', 'MenuController@destroy')->name('menu.delete');

		// rutas para submenu
		Route::get('/add/{menu}', 'SubMenuController@index')->name('menu.add');
		Route::post('/add', 'SubMenuController@store')->name('menu.add');
		Route::get('find_sub', 'SubMenuController@find')->name('menu.find_sub');
		Route::get('/anular_sub/{submenu}', 'SubMenuController@anular')->name('menu.anular_sub');
		Route::get('/activar_sub/{submenu}', 'SubMenuController@activar')->name('menu.activar_sub');
		Route::get('/delete_sub/{submenu}', 'SubMenuController@destroy')->name('menu.delete_sub');
		Route::get('/edit_sub/{submenu}', 'SubMenuController@edit')->name('menu.edit_sub');
		Route::post('/edit_sub/{submenu}', 'SubMenuController@update')->name('menu.edit_sub');
	});	

	// rutas para roles
	Route::group(['prefix' => 'rol'], function () {
		Route::get('/', 'RoleController@index')->name('rol');
		Route::get('/find', 'RoleController@find')->name('rol.find');
		Route::get('/create', 'RoleController@create')->name('rol.create');
		Route::post('/create', 'RoleController@store')->name('rol.create');
		Route::get('/delete/{rol}', 'RoleController@destroy')->name('rol.delete');
		Route::get('/anular/{rol}', 'RoleController@anular')->name('rol.anular');
		Route::get('/activar/{rol}', 'RoleController@activar')->name('rol.activar');
		Route::get('/edit/{rol}', 'RoleController@edit')->name('rol.edit');
		Route::put('/update/{rol}', 'RoleController@update')->name('rol.update');
	});

	// rutas para usuarios
	Route::group(['prefix' => 'usuario'], function () {
		Route::get('/', 'UserController@index')->name('usuario');
		Route::get('/find', 'UserController@find')->name('usuario.find');
		Route::get('/create', 'UserController@create')->name('usuario.create');
		Route::post('/create', 'UserController@store')->name('usuario.create');
		Route::get('/delete/{user}', 'UserController@destroy')->name('usuario.delete');
		Route::get('/anular/{user}', 'UserController@anular')->name('usuario.anular');
		Route::get('/activar/{user}', 'UserController@activar')->name('usuario.activar');
		Route::get('/edit/{user}', 'UserController@edit')->name('usuario.edit');
		Route::put('/update/{user}', 'UserController@update')->name('usuario.update');
	});

	///Periodo
	Route::group(['prefix' => 'periodo'], function () {
		Route::get('/', 'PeriodoController@index')->name('periodo');
		Route::get('/find', 'PeriodoController@find')->name('periodo.find');
		
	});

});