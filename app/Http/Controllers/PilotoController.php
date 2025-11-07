<?php

namespace App\Http\Controllers;

use App\Models\Piloto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $messages = [

            'nombre.required' => 'El nombre del piloto es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre excede el tamaño máximo (255 caracteres).',

            'altura.integer' => 'La altura debe ser un número entero (ej: 180).',
            'altura.min' => 'La altura no puede ser un valor negativo.',

            'anio_nacimiento.string' => 'El año de nacimiento debe ser una cadena de texto.',
            'anio_nacimiento.max' => 'El año de nacimiento excede el tamaño máximo (255 caracteres).',

            'genero.string' => 'El género debe ser una cadena de texto.',
            'genero.max' => 'El género excede el tamaño máximo (255 caracteres).',

            //siempre que se crea un piloto adquiere la imagen por default
        ];

        $rules = [
            'nombre' => 'required|string|max:255',
            'altura' => 'nullable|integer|min:0',
            'anio_nacimiento' => 'nullable|string|max:255',
            'genero' => 'nullable|string|max:255',

        ];


        $validator = Validator::make($req->all(), $rules, $messages);


        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $validatedData = $validator->validated();
        $validatedData['imagen'] = "http://127.0.0.1:8000/storage/perfiles/anon-user-profile.jpg";
        $piloto = new Piloto;
        try {
            $piloto = $piloto->create($validatedData);
            return response()->json($piloto, 200);

        } catch (\Exception $e) {
            return response()->json(['mensaje' => 'Error al crear: ' . $e->getMessage()], 404);
        }
    }
}
