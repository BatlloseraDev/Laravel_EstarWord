<?php

namespace App\Http\Controllers;

use App\Models\Piloto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class CloudinaryController extends Controller
{
    public function subirImagenCloud(Request $request, $idpiloto)
    {

        $messages = [
            'image.required' => 'Falta el archivo',
            'image.mimes' => 'Tipo no soportado',
            'image.max' => 'El archivo excede el tamaño máximo permitido',
        ];

        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], $messages);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            try {
                $file = $request->file('image');

                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();


                $filename = uniqid('img_') . '_' . Str::slug($originalName) . '.' . $extension;


                $uploadedFilePath = Storage::disk('cloudinary')->putFileAs('laravel', $file, $filename);


                $url = Storage::disk('cloudinary')->url($uploadedFilePath);


                $piloto = Piloto::findOrFail($idpiloto);
                $piloto->imagen = $url;
                $piloto->save();

                //en vez de devolver la url de la imagen devuelvo si ha habido exito
                return response()->json(['exito' => 'Imagen subida correctamente'], 200);

            } catch (\Exception $e) {
                return response()->json(['error' => 'Error al subir la imagen: ' . $e->getMessage()], 500);
            }
        }

        return response()->json(['error' => 'No se recibió ningún archivo.'], 400);
    }
}
