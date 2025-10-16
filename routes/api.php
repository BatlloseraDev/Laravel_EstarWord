<?php

use App\Http\Controllers\EjercicioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix('naves')
    ->group(function(){
        Route::get('/',[EjercicioController::class, 'getNaves']);
    });
