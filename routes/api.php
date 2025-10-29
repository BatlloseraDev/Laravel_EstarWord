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
        Route::get('/navesPilotos', [EjercicioController::class, 'getNavesPilotos'])->middleware('alguno: midadmin, midgestor, miduser');

        Route::get('/planetas/{id}', [EjercicioController::class, 'getPlaneta'])->where('id', '[0-9]+')->middleware('alguno: midadmin, midgestor, miduser');
        Route::get('/planetas', [EjercicioController::class, 'getPlanetas'])->middleware('alguno: midadmin, midgestor, miduser');

        Route::get('/pilotos/{id}', [EjercicioController::class, 'getPiloto'])->where('id', '[0-9]+')->middleware('alguno: midadmin, midgestor, miduser');
        Route::get('/pilotos', [EjercicioController::class, 'getPilotos'])->middleware('alguno: midadmin, midgestor, miduser');
        Route::get('/pilotosConNaveHistorico', [EjercicioController::class, 'getPilotosConNaveHistorico'])->middleware('alguno: midadmin, midgestor, miduser');
        Route::get('/pilotosConNaveActual', [EjercicioController::class, 'getPilotosConNaveActual'])->middleware('alguno: midadmin, midgestor, miduser');

        Route::get('/mantenimientos/{id}', [EjercicioController::class, 'getMantenimento'])->where('id', '[0-9]+')->middleware('alguno: midadmin, midgestor, miduser');
        Route::get('/listarMantenimientoPuntual', [EjercicioController::class, 'listarMantenimientoPuntual'])->middleware('alguno: midadmin, midgestor, miduser');
        Route::get('/listarMantenimientosFechas/{fecha1}/{fecha2}', [EjercicioController::class, 'listarMantenimientosFechas'])->middleware('alguno: midadmin, midgestor, miduser');
        Route::get('/mantenimientos', [EjercicioController::class, 'getMantenimientos'])->middleware('alguno: midadmin, midgestor, miduser');

        Route::get('/naves/{id}', [NaveController::class, 'getNave'])->where('id', '[0-9]+')->middleware('alguno: midadmin, midgestor, miduser');
        Route::get('/naves', [NaveController::class, 'getNaves'])->middleware('alguno: midadmin, midgestor, miduser');
        Route::get('/navesSinPiloto', [EjercicioController::class, 'getNavesSinPiloto'])->middleware('alguno: midadmin, midgestor, miduser');

        Route::get('/usuarios/{id}', [EjercicioController::class, 'getUsuario'])->middleware('midadmin')->where('id', '[0-9]+');
        Route::get('/usuarios', [EjercicioController::class, 'getUsuarios'])->middleware('midadmin');

        Route::get('/', [EjercicioController::class, 'getAllInfo'])->middleware('midadmin');
    });


    Route::prefix('naves')->group(function () {
        Route::put('/{id}', [NaveController::class, 'updateNave'])->where('id', '[0-9]+')->middleware('alguno: midadmin, midgestor');
        Route::delete('/{id}', [NaveController::class, 'deleteNave'])->where('id', '[0-9]+')->middleware('alguno: midadmin, midgestor');
        Route::post('/', [NaveController::class, 'addNave'])->middleware('alguno: midadmin, midgestor');
    });



    Route::prefix('gestionarNavePiloto')->group(function () {
        Route::post('/asignar/{idnave}/{idpiloto}', [EjercicioController::class, 'asignarPiloto'])
        ->where(['idnave' => '[0-9]+','idpiloto' => '[0-9]+'])
        ->middleware('alguno: midadmin, midgestor');
        Route::put('/desasignar/{idnave}/{idpiloto}', [EjercicioController::class, 'desasignarPiloto'])
        ->where(['idnave' => '[0-9]+','idpiloto' => '[0-9]+'])
        ->middleware('alguno: midadmin, midgestor');
    });


    Route::post('/CrearMantenimiento', [EjercicioController::class, 'addMantenimiento'])
    ->middleware('alguno: midadmin, midgestor');



});









// Route::put('gestionarNavePiloto')
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('register', [AuthController::class, 'register']);


Route::get('/nologin', function () {
    return response()->json(["success" => false, "message" => "Unauthorised"], 203);
});
