<?php
use Illuminate\Support\Facades\Route;
use App\User;
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

Route::any('activar/{token}', function($token) {
	
      $user=User::where('remember_token','LIKE',"$token")->first();
      
      if($user!=null && count($user)>0){
            $user->activo=1;
            $user->save();

        echo "Cuenta Activada <br>";
        echo '<a href="intent:#Intent;action=com.example.jgchan.datemypet;category=android.intent.category.DEFAULT;category=android.intent.category.BROWSABLE;S.msg_from_browser=Launched%20from%20Browser;end">Presione Aqui para ir a la app</a>';

      }else{
        echo "Error";
      }

});



Route::any('Hora', function(){

      dd(\Carbon\Carbon::now()->format("d/m/Y h:i:s A"));

      
});

