<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("login","api\auth\UserController@login");

Route::post("registrar","api\auth\UserController@register");


// Route::group(['middleware' => 'auth:api'], function(){
    Route::group([], function(){

    Route::post('detalles', 'api\auth\UserController@details');


//---------------------------MASCOTAS-------------------------------------------------------------
   
Route::get('mismascotas/{idUsuario}/listado', [
        'uses' => 'MascotaController@index',
        'as' => 'mascotas.index'
    ]);

    Route::get('mascota/{idMascota}/visualizar', [
        'uses' => 'MascotaController@show',
        'as' => 'mascotas.ver'
    ]);

    Route::get('mascota/{idMascota}/editar', [
        'uses' => 'MascotaController@edit',
        'as' => 'mascotas.editar'
    ]);

    Route::post('mascota/crear/nueva', [
        'uses' => 'MascotaController@store',
        'as' => 'mascotas.guardar'
    ]);

    Route::put('mascota/{idMascota}/actualizar', [
        'uses' => 'MascotaController@update',
        'as' => 'mascotas.actualizar'
    ]);

//-------------------------------------------------------------------------------------------------
    
});