<?php
use Illuminate\Support\Facades\Route;
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
	dd($value);
}

});






