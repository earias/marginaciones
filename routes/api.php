<?php

use Illuminate\Http\Request;


Route::get('marginaciones', 'MarginacionesController@index');
Route::post('/add-marginacion', 'MarginacionesController@store');
Route::get('/edit-marginacion/{id}', 'MarginacionesController@edit');
Route::put('/update-marginacion/{id}', 'MarginacionesController@update');
Route::delete('/delete-marginacion/{id}', 'MarginacionesController@destroy');



// Route::get('marginaciones', [MarginacionesController::class, 'index']);
// Route::post('/add-marginacion', [MarginacionesController::class, 'store']);
// Route::get('/edit-marginacion/{id}', [MarginacionesController::class, 'edit']);
// Route::put('update-marginacion/{id}', [MarginacionesController::class, 'update']);
// Route::delete('delete-marginacion/{id}', [MarginacionesController::class, 'destroy']);

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/register','UserController@register');
Route::post('/reactlogin','UserController@login');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


