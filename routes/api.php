<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\EjercicioController;

use App\Http\Controllers\NaveController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');



// Route::get('/naves', [EjercicioController::class, 'getNaves']);
Route::middleware('auth:sanctum')->group(function () {



    Route::prefix('/info')->group(function () {
        Route::get('/navesPilotos', [EjercicioController::class, 'getNavesPilotos']);

        Route::get('/planetas/{id}', [EjercicioController::class, 'getPlaneta'])->where('id', '[0-9]+');
        Route::get('/planetas', [EjercicioController::class, 'getPlanetas']);

        Route::get('/pilotos/{id}', [EjercicioController::class, 'getPiloto'])->where('id', '[0-9]+');
        Route::get('/pilotos', [EjercicioController::class, 'getPilotos']);
        Route::get('/pilotosConNaveHistorico', [EjercicioController::class, 'getPilotosConNaveHistorico']);
        Route::get('/pilotosConNaveActual', [EjercicioController::class, 'getPilotosConNaveActual']);

        Route::get('/mantenimientos/{id}', [EjercicioController::class, 'getMantenimento'])->where('id', '[0-9]+');
        Route::get('/listarMantenimientoPuntual', [EjercicioController::class, 'listarMantenimientoPuntual']);
        Route::get('/listarMantenimientosFechas/{fecha1}/{fecha2}', [EjercicioController::class, 'listarMantenimientosFechas']);
        Route::get('/mantenimientos', [EjercicioController::class, 'getMantenimientos']);

        Route::get('/naves/{id}', [NaveController::class, 'getNave'])->where('id', '[0-9]+');
        Route::get('/naves', [NaveController::class, 'getNaves']);
        Route::get('/navesSinPiloto', [EjercicioController::class, 'getNavesSinPiloto']);

        Route::get('/usuarios/{id}', [EjercicioController::class, 'getUsuario'])->middleware('admin')->where('id', '[0-9]+');
        Route::get('/usuarios', [EjercicioController::class, 'getUsuarios'])->middleware('admin');

        Route::get('/', [EjercicioController::class, 'getAllInfo'])->middleware('admin');
    });


    Route::prefix('naves')->group(function () {
        Route::put('/{id}', [NaveController::class, 'updateNave'])->where('id', '[0-9]+');
        Route::delete('/{id}', [NaveController::class, 'deleteNave'])->where('id', '[0-9]+');
        Route::post('/', [NaveController::class, 'addNave']);
    });



    Route::prefix('gestionarNavePiloto')->group(function () {
        Route::post('/asignar/{idnave}/{idpiloto}', [EjercicioController::class, 'asignarPiloto'])
        ->where(['idnave' => '[0-9]+','idpiloto' => '[0-9]+'])
        ->middleware('alguno: admin, gestor');
        Route::put('/desasignar/{idnave}/{idpiloto}', [EjercicioController::class, 'desasignarPiloto'])
        ->where(['idnave' => '[0-9]+','idpiloto' => '[0-9]+'])
        ->middleware('alguno: admin, gestor');
    });


    Route::post('/CrearMantenimiento', [EjercicioController::class, 'addMantenimiento']);

});









// Route::put('gestionarNavePiloto')
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('register', [AuthController::class, 'register']);


Route::get('/nologin', function () {
    return response()->json(["success" => false, "message" => "Unauthorised"], 203);
});
