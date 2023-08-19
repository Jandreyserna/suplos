<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProcessController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClasificatorsController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Crear proceso/evento en el sistema
Route::post('/crear-evento', [ProcessController::class, 'crearEvento']);

//consultar todas las actividades
Route::get('/consultar-actividades', [ClasificatorsController::class, 'buscarActividades']);

//consultar todos los preocesos
Route::get('/consultar-procesos', [ProcessController::class, 'buscarProcesos']);


