<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Administrador\UserController;
use App\Http\Controllers\CitasController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\TratamientoController;
use App\Http\Controllers\HistorialController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'inicio'])->name('inicio');


route::post('uploadperfil',[App\Http\Controllers\Perfilcontroller::class, 'uploadperfil'])->name('uploadperfil');
route::get('/listauser',[UserController::class, 'index'])->name('usuarios');// todo los usuarios para paginacion
route::get('/listauser/{id}',[UserController::class, 'buscar'])->name('buscarusuarios');

route::get('/reniec/{id}',[UserController::class, 'reniec'])->name('reniec');
Route::post('newuser', [UserController::class, 'newuser'])->name('newuser');
Route::get('rolesuser', [UserController::class, 'rolesuser'])->name('rolesuser');
Route::delete('/borraruser/{id}', [UserController::class, 'borraruser'])->name('borraruser');

Route::post('nuevacita', [CitasController::class, 'nuevacita'])->name('nuevacita');
Route::post('nuevacitapaciente', [CitasController::class, 'nuevacitapaciente'])->name('nuevacitapaciente');

Route::get('listacitas', [CitasController::class, 'show'])->name('show');
Route::get('citaspendientes', [CitasController::class, 'citapendiente'])->name('citapendiente');

Route::get('servicios', [ServiciosController::class, 'index'])->name('servicios.index');

/// registro de tratamiento
Route::get('listatratamiento', [TratamientoController::class, 'index'])->name('tratamientos.index');
Route::get('listatratamiento/{id}', [TratamientoController::class, 'tratamientoxid'])->name('tratamientoxid.index');
Route::post('/tratamiento-nuevo', [TratamientoController::class, 'nuevotratamiento'])->name('nuevotratamiento');

Route::post('/addhistorial', [HistorialController::class, 'addhistorial'])->name('addhistorial');

// Home Route
Route::get('/reportes', [App\Http\Controllers\HomeController::class, 'reportes'])->name('reportes');


// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/{any?}', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->where('any','.*');
