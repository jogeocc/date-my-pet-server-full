<?php
use Illuminate\Support\Facades\Route;
use App\User;
use App\Mascota;
//use Illuminate\Routing\Route;
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
    return view('welcome');
});

Route::get('login', function ($id) {
    return view("welcome");
})->name("login");

Route::any('rutas', function() {
	$routeCollection = Route::getRoutes();
   
foreach ($routeCollection as $value) {
   
    if( $value->getName())echo $value->uri."<BR>";

    }
});

Route::get('visualizar/{idMascota}/historial-pdf', [
    'uses' => 'GeneradorPdfController@visualizar',
    'as' => 'pdf.visualizar'
]);

Route::any('activar/{token}', function($token) {
	
      $user=User::where('remember_token','LIKE',"$token")->first();
      $activo =0;
      if($user!=null && count($user)>0){
            $user->activo=1;
            $user->save();

        $activo=1;

      }
        
      return view("activacion")->with(["activo"=>$activo]);

});


Route::any('visualizar/{idMascota}/historial', function() {
	    
        $mascota = Mascota::find(12);
        $historial = $mascota->historial;
        $registros = $historial->registrosmedicos;
      return view("historial")->with(['mascota'=>$mascota,'registros'=>$registros]);

});



Route::any('Hora', function(){
      dd(\Carbon\Carbon::now()->format("d/m/Y h:i:s A"));
});





