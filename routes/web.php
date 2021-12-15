<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EmpleadoController;

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
    return view('auth.login');
});

// Accede al template index que está en la carpeta empleado
/* Route::get('/empleado', function() {
    return view('empleado.index');
});*/

// Solo accede al método create
/*Route::get( '/empleado/create', [EmpleadoController::class, 'create'] ); */

// Accede a todos los métodos de la clase
Route::resource('empleado', EmpleadoController::class)->middleware('auth');

Auth::routes(['register'=>false,'reset'=>false]);

Route::get('/home', [EmpleadoController::class, 'index'])->name('home');



Route::group(['middleware' => 'auth'],function () {

    Route::get('/home', [EmpleadoController::class, 'index'])->name('home');
});