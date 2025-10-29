<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nave;

class NaveController extends Controller
{
    public function getNaves()
    {
        $naves = Nave::all();

        return response()->json($naves, 200);
    }

    public function getNave($id)
    {
        $nave = Nave::find($id);

        return response()->json($nave, 200);
    }

    public function addNave(Request $req)
    {

        $nave = new Nave;
        try {
            $nave = $nave->create($req->all());
            return response()->json($nave, 200);

        } catch (\Exception $e) {
            return response()->json(['mensaje' => 'Error al crear: ' . $e->getMessage()], 404);
        }
    }

    public function updateNave(Request $req, $id)
    {
        $nave = Nave::find($id);
        try {
            $nave->merge($req->all());
            $nave->save();
            return response()->json($nave, 200);
        } catch (\Exception $e) {
            return response()->json(['mensaje' => 'Error al actualizar: ' . $e->getMessage()], 404);
        }

    }


    public function deleteNave($id)
    {
        $nave = Nave::find($id);
        try {
            $nave->delete();
            return response()->json(['mensaje' => 'Nave borrada']);
        } catch (\Exception $e) {
            return response()->json(['mensaje' => 'Error al borrar: ' . $e->getMessage()], 404);
        }

    }
}
