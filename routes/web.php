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


Route::any('email', function() {
	 $user = User::findOrFail(34);

        Mail::send('emails.confirmacion', ['user' => $user], function ($m) use ($user) {
            $m->from('DateMyPet@date-my-pet-mx.tk', 'Date My Pet');

            $m->to("jogeochanc@gmail.com", "Jose GEocany")->subject('Your Reminder!');
        });

});


Route::any('correo', function() {
	 return view("emails.confirmacion");

});


