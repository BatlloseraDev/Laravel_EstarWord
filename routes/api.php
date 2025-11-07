<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\CloudinaryController;
use App\Http\Controllers\EjercicioController;

use App\Http\Controllers\NaveController;
use App\Http\Controllers\PilotoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');



// Route::get('/naves', [EjercicioController::class, 'getNaves']);
Route::middleware('auth:sanctum')->group(function () {



    Route::prefix('/info')->group(function () {
        Route::get('/navesPilotos', [EjercicioController::class, 'getNavesPilotos'])->middleware('alguno:admin,gestor,user');

        Route::get('/planetas/{id}', [EjercicioController::class, 'getPlaneta'])->where('id', '[0-9]+')->middleware('alguno:admin,gestor,user');
        Route::get('/planetas', [EjercicioController::class, 'getPlanetas'])->middleware('alguno:admin,gestor,user');

        Route::get('/pilotos/{id}', [EjercicioController::class, 'getPiloto'])->where('id', '[0-9]+')->middleware('alguno:admin,gestor,user');
        Route::get('/pilotos', [EjercicioController::class, 'getPilotos'])->middleware('alguno:admin,gestor,user');
        Route::get('/pilotosConNaveHistorico', [EjercicioController::class, 'getPilotosConNaveHistorico'])->middleware('alguno:admin,gestor,user');
        Route::get('/pilotosConNaveActual', [EjercicioController::class, 'getPilotosConNaveActual'])->middleware('alguno:admin,gestor,user');

        Route::get('/mantenimientos/{id}', [EjercicioController::class, 'getMantenimento'])->where('id', '[0-9]+')->middleware('alguno:admin,gestor,user');
        Route::get('/listarMantenimientoPuntual', [EjercicioController::class, 'listarMantenimientoPuntual'])->middleware('alguno:admin,gestor,user');
        Route::get('/listarMantenimientosFechas/{fecha1}/{fecha2}', [EjercicioController::class, 'listarMantenimientosFechas'])->middleware('alguno:admin,gestor,user');
        Route::get('/mantenimientos', [EjercicioController::class, 'getMantenimientos'])->middleware('alguno:admin,gestor,user');

        Route::get('/naves/{id}', [NaveController::class, 'getNave'])->where('id', '[0-9]+')->middleware('alguno:admin,gestor,user');
        Route::get('/naves', [NaveController::class, 'getNaves'])->middleware('alguno:admin,gestor,user');
        Route::get('/navesSinPiloto', [EjercicioController::class, 'getNavesSinPiloto'])->middleware('alguno:admin,gestor,user');

        Route::get('/usuarios/{id}', [EjercicioController::class, 'getUsuario'])->middleware('midadmin')->where('id', '[0-9]+');
        Route::get('/usuarios', [EjercicioController::class, 'getUsuarios'])->middleware('midadmin');

        Route::get('/', [EjercicioController::class, 'getAllInfo'])->middleware('midadmin');
    });


    Route::prefix('naves')->group(function () {
        Route::put('/{id}', [NaveController::class, 'updateNave'])->where('id', '[0-9]+')->middleware('alguno:admin,gestor');
        Route::delete('/{id}', [NaveController::class, 'deleteNave'])->where('id', '[0-9]+')->middleware('alguno:admin,gestor');
        Route::post('/', [NaveController::class, 'addNave'])->middleware('alguno:admin,gestor');
    });



    Route::prefix('gestionarNavePiloto')->group(function () {
        Route::post('/asignar/{idnave}/{idpiloto}', [EjercicioController::class, 'asignarPiloto'])
            ->where(['idnave' => '[0-9]+', 'idpiloto' => '[0-9]+'])
            ->middleware('alguno:admin,gestor');
        Route::put('/desasignar/{idnave}/{idpiloto}', [EjercicioController::class, 'desasignarPiloto'])
            ->where(['idnave' => '[0-9]+', 'idpiloto' => '[0-9]+'])
            ->middleware('alguno:admin,gestor');
    });


    Route::post('/subirImagen/{idpiloto}', [CloudinaryController::class, 'subirImagenCloud'])->where('idpiloto', '[0-9]+')->middleware('alguno:admin,gestor');

    Route::post('/CrearMantenimiento', [EjercicioController::class, 'addMantenimiento'])
        ->middleware('alguno:admin,gestor');



});


Route::prefix('pilotos')->group(function () {
    Route::put('/{id}', [PilotoController::class, 'updatePiloto'])->where('id', '[0-9]+')->middleware('alguno:admin,gestor');
    Route::delete('/{id}', [PilotoController::class, 'deletePiloto'])->where('id', '[0-9]+')->middleware('alguno:admin,gestor');
    Route::post('/', [PilotoController::class, 'addPiloto'])->middleware('alguno:admin,gestor');
});





// Route::put('gestionarNavePiloto')
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('register', [AuthController::class, 'register']);


Route::get('/nologin', function () {
    return response()->json(["success" => false, "message" => "Unauthorised"], 203);
});
