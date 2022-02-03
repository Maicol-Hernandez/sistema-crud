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

Route::get('/welcon', function () {
    return view('welcon');
});
/**
 *

Route::get('empleado/create', [EmpleadoController::class, 'create'] );
 
 */

// Route::get('/form', function () {
//     return view('empleado.form');    
// });

Route::resource('empleado', EmpleadoController::class)->middleware('auth');

// ['register' => false, 'reset' => false]
Auth::routes();


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [EmpleadoController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [EmpleadoController::class, 'index'])->name('home');
});


/**
 
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
 
 */
