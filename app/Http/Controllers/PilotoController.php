<?php

namespace App\Http\Controllers;

use App\Models\Piloto;
use Illuminate\Http\Request;

class PilotoController extends Controller
{
   public function updatePiloto(Request $req, $id)
   {
        $piloto = Piloto::find($id);
        try {
            $piloto->merge($req->all());
            $piloto->save();
            return response()->json($piloto, 200);
        } catch (\Exception $e) {
            return response()->json(['mensaje' => 'Error al actualizar: ' . $e->getMessage()], 404);
        }

   }

   public function deletePiloto($id)
   {
        $piloto = Piloto::find($id);
        try {
            $piloto->delete();
            return response()->json(['mensaje' => 'Piloto borrado'], 200);
        } catch (\Exception $e) {
            return response()->json(['mensaje' => 'Error al borrar: ' . $e->getMessage()], 404);
        }
   }

   public function addPiloto(Request $req)
   {
        $piloto = new Piloto;
        try {
            $piloto = $piloto->create($req->all());
            return response()->json($piloto, 200);

        } catch (\Exception $e) {
            return response()->json(['mensaje' => 'Error al crear: ' . $e->getMessage()], 404);
        }
   }
}
