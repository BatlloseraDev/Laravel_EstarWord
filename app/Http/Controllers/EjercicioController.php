<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Nave;


class EjercicioController extends Controller
{
    public function getNaves()
    {
        $naves = Nave::all();

        return response()->json($naves,200);
    }
}
