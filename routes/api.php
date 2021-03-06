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

//------------------------- USUARIOS -----------------------------------------------------------

Route::get('usuario/{idUsuario}/ver', [
    'uses' => 'api\auth\UserController@show',
    'as' => 'usuario.show'
]);

Route::get('usuario/{idUsuario}/editar', [
    'uses' => 'api\auth\UserController@edit',
    'as' => 'usuario.edit'
]);

Route::get('usuario/{idUsuario}/eliminarcuenta', [
    'uses' => 'api\auth\UserController@destroy',
    'as' => 'usuario.destroy'
]);

Route::put('usuario/{idUsuario}/actualizar', [
    'uses' => 'api\auth\UserController@update',
    'as' => 'usuario.update'
]);

//---------------------------MASCOTAS-------------------------------------------------------------
   
    Route::get('mismascotas/{idUsuario}/listado', [
        'uses' => 'MascotaController@index',
        'as' => 'mascotas.index'
    ]);

    Route::get('mascota/{idMascota}/visualizar', [
        'uses' => 'MascotaController@show',
        'as' => 'mascotas.ver'
    ]);

    Route::get('mascota/{idMascota}/compartir', [
        'uses' => 'MascotaController@compartirPerfil',
        'as' => 'mascotas.compartir'
    ]);

    
    Route::get('mascota/{idMascota}/editar', [
        'uses' => 'MascotaController@edit',
        'as' => 'mascotas.editar'
    ]);


    Route::get('mascota/{idMascota}/eliminar', [
        'uses' => 'MascotaController@destroy',
        'as' => 'mascotas.eliminar'
    ]);

    Route::get('usuario/{idUsuario}/tiene-mascotas', [
        'uses' => 'MascotaController@tieneMascotas',
        'as' => 'mascotas.tienemascotas'
    ]);

    Route::post('mascota/crear/nueva', [
        'uses' => 'MascotaController@store',
        'as' => 'mascotas.guardar'
    ]);

    Route::post('mascota/actualizar', [
        'uses' => 'MascotaController@actualizar',
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

    Route::get('registro-medico/ver', [
        'uses' => 'HistorialController@show',
        'as' => 'registro.ver'
    ]);

//-------------------------------------------------------------------------------------------------

//------------------- VACUNAS ---------------------------------------------------------------------//

Route::get('mascota/{idMascota}/vacunas', [
    'uses' => 'VacunaController@visualizarVacunas',
    'as' => 'vacuna.listado'
]);


Route::get('vacuna/{idVacuna}/visualizar', [
    'uses' => 'VacunaController@show',
    'as' => 'vacuna.visualizar'
]);


Route::get('vacuna/{idVacuna}/eliminar', [
    'uses' => 'VacunaController@destroy',
    'as' => 'vacuna.eliminar'
]);


Route::post('vacuna/crear/nueva', [
    'uses' => 'VacunaController@store',
    'as' => 'vacuna.guardar'
]);

Route::put('vacuna/{idVacuna}/actualizar', [
    'uses' => 'VacunaController@update',
    'as' => 'vacuna.actualizar'
]);


//---------------------------------------------------------------------------------------------------


//--------------------- CITAS -----------------------------------------------------------------------

Route::get('citas/{idUsuario}/listado', [
    'uses' => 'CitaController@index',
    'as' => 'cita.listado'
]);

Route::get('citas/{idUsuario}/miscitas', [
    'uses' => 'CitaController@listaMisCitas',
    'as' => 'cita.miscitas'
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

Route::get('citas/{idCita}/eliminar', [
    'uses' => 'CitaController@destroy',
    'as' => 'cita.eliminar'
]);


//----------------------------------------------------------------------------------------------------

//---------------------- VEterinario ---------------------------------------------------------------

Route::get('veterinarios/{idUsuario}/listado', [
    'uses' => 'VeterinarioController@index',
    'as' => 'veterinario.listado'
]);

Route::get('usuario/{idUsuario}/tiene-veterinarios', [
    'uses' => 'VeterinarioController@tieneVeterinarios',
    'as' => 'veterinario.tieneveterinario'
]);

Route::get('veterinarios/{idVeterinario}/visualizar', [
    'uses' => 'VeterinarioController@show',
    'as' => 'veterinario.ver'
]);

Route::get('veterinarios/{idVeterinario}/editar', [
    'uses' => 'VeterinarioController@edit',
    'as' => 'veterinario.editar'
]);

Route::get('veterinarios/{idVeterinario}/eliminar', [
    'uses' => 'VeterinarioController@destroy',
    'as' => 'veterinario.eliminar'
]);

Route::post('veterinarios/crear/nueva', [
    'uses' => 'VeterinarioController@store',
    'as' => 'veterinario.guardar'
]);

Route::put('veterinarios/{idVeterinario}/actualizar', [
    'uses' => 'VeterinarioController@update',
    'as' => 'veterinario.actualizar'
]);

Route::get('generar/{idMascota}/historial', [
    'uses' => 'GeneradorPdfController@pdf',
    'as' => 'pdf.generar'
]);


//-----------------------------------------------------------------------------------------------------


});
