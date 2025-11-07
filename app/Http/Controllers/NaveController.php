<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
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

        $messages = [
            'planeta_id.required' => 'El planeta de origen es obligatorio.',
            'planeta_id.integer' => 'El ID del planeta debe ser un número.',
            'planeta_id.exists' => 'El planeta seleccionado no existe en nuestra base de datos.',

            'nombre.required' => 'El nombre de la nave es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre excede el tamaño máximo permitido (255 caracteres).',

            'modelo.required' => 'El modelo de la nave es obligatorio.',
            'modelo.string' => 'El modelo debe ser una cadena de texto.',
            'modelo.max' => 'El modelo excede el tamaño máximo permitido (255 caracteres).',

            'tripulacion.integer' => 'El número de tripulantes debe ser un número entero.',
            'tripulacion.min' => 'El número de tripulantes no puede ser negativo.',

            'pasajeros.integer' => 'El número de pasajeros debe ser un número entero.',
            'pasajeros.min' => 'El número de pasajeros no puede ser negativo.',

            'clase_nave.string' => 'La clase de nave debe ser una cadena de texto.',
            'clase_nave.max' => 'La clase de nave excede el tamaño máximo permitido (255 caracteres).',
        ];


        $rules = [
            'planeta_id' => 'required|integer|exists:planetas,id',
            'nombre' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'tripulacion' => 'nullable|integer|min:0',
            'pasajeros' => 'nullable|integer|min:0',
            'clase_nave' => 'nullable|string|max:255',
        ];

        $validator = Validator::make($req->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

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
