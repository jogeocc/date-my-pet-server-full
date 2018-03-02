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

Route::post("logintemp","api\auth\LoginController@login");

Route::post("login","api\auth\UserController@login");

Route::post("registrar","api\auth\UserController@register");

Route::post('refresh', 'api\auth\LoginController@refresh');


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

//---------------------------HISTORIAL MEDICO -----------------------------------------------------

    Route::get('historialmedico/{idHistorial}/registros', [
        'uses' => 'HistorialController@index',
        'as' => 'historial.listado'
    ]);

    Route::post('historialmedico/registro/nuevo', [
        'uses' => 'HistorialController@store',
        'as' => 'registro.guardar'
    ]);

    Route::post('registro-medico/ver', [
        'uses' => 'HistorialController@show',
        'as' => 'registro.ver'
    ]);

//-------------------------------------------------------------------------------------------------

//------------------- VACUNAS ---------------------------------------------------------------------//




//---------------------------------------------------------------------------------------------------


//--------------------- CITAS -----------------------------------------------------------------------

Route::get('citas/{idUsuario}/listado', [
    'uses' => 'CitaController@index',
    'as' => 'cita.listado'
]);


Route::get('citas/{idCita}/visualizar', [
    'uses' => 'CitaController@show',
    'as' => 'cita.ver'
]);

Route::get('citas/{idCita}/editar', [
    'uses' => 'CitaController@edit',
    'as' => 'cita.editar'
]);

Route::post('citas/crear/nueva', [
    'uses' => 'CitaController@store',
    'as' => 'cita.guardar'
]);

Route::put('citas/{idCita}/actualizar', [
    'uses' => 'CitaController@update',
    'as' => 'cita.actualizar'
]);


//----------------------------------------------------------------------------------------------------

//---------------------- VEterinario ---------------------------------------------------------------

Route::get('veterinarios/{idUsuario}/listado', [
    'uses' => 'VeterinarioController@index',
    'as' => 'veterinario.listado'
]);

Route::get('veterinarios/{idCita}/visualizar', [
    'uses' => 'VeterinarioController@show',
    'as' => 'veterinario.ver'
]);

Route::get('veterinarios/{idCita}/editar', [
    'uses' => 'VeterinarioController@edit',
    'as' => 'veterinario.editar'
]);

Route::post('veterinarios/crear/nueva', [
    'uses' => 'VeterinarioController@store',
    'as' => 'veterinario.guardar'
]);

Route::put('veterinarios/{idCita}/actualizar', [
    'uses' => 'VeterinarioController@update',
    'as' => 'veterinario.actualizar'
]);



//-----------------------------------------------------------------------------------------------------


});