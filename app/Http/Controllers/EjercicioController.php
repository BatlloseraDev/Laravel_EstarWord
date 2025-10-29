<?php

namespace App\Http\Controllers;

use App\Models\Mantenimiento;
use App\Models\Nave_Piloto;
use App\Models\Piloto;
use App\Models\Planeta;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

use App\Models\Nave;


class EjercicioController extends Controller
{


    public function getAllInfo()
    {
        //Listado de toda la información almacenada. Listados generales y búsquedas por id.

        $naves = Nave_Piloto::with(['nave.planeta', 'piloto'])->get();
        $mantenimientos = Mantenimiento::with(['nave'])->get();
        return response()->json(['naves' => $naves, 'mantenimientos' => $mantenimientos], 200);
    }


    public function asignarPiloto(Request $req, $idnave, $idpiloto)
    {

        try {
            $piloto = Piloto::findOrFail($idpiloto);
            $nave = Nave::findOrFail($idnave);

            $nave_piloto = Nave_Piloto::where('nave_id', $idnave)->where('piloto_id', $idpiloto)->get();
            if ($nave_piloto->count() > 0) {
                foreach ($nave_piloto as $navPil) {
                    if ($navPil->fecha_fin_asociacion === null || Carbon::parse($navPil->fecha_fin_asociacion)->greaterThan(Carbon::now())) {
                        throw new Exception("Ya existe esa nave asiganada a ese piloto en una fecha aun no finalizada");
                    }
                }
            }
            $nave_piloto = new Nave_Piloto;
            $nave_piloto->nave_id = $idnave;
            $nave_piloto->piloto_id = $idpiloto;
            $nave_piloto->fecha_asociacion = Carbon::now();
            $nave_piloto->save();
            return response()->json($nave_piloto, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Piloto o Nave no encontrada'
            ], 404);

        } catch (\Exception $e) {
            return response()->json(['mensaje' => 'Error al crear: ' . $e->getMessage()], 404);
        }

    }


    public function desasignarPiloto(Request $req, $idnave, $idpiloto)
    {
        try {
            $piloto = Piloto::findOrFail($idpiloto);
            $nave = Nave::findOrFail($idnave);

            $nave_piloto = Nave_Piloto::where('nave_id', $idnave)->where('piloto_id', $idpiloto)->get();
            if ($nave_piloto->count() == 0) {
                throw new Exception("No existe esa nave asiganada a ese piloto");

            }

            foreach ($nave_piloto as $navPil) {
                if ($navPil->fecha_fin_asociacion === null || Carbon::parse($navPil->fecha_fin_asociacion)->greaterThan(Carbon::now())) {

                    $resultado = Nave_Piloto::where('nave_id', $idnave)
                        ->where('piloto_id', $idpiloto)
                        ->where('fecha_asociacion', $navPil->fecha_asociacion)
                        ->update([
                            'fecha_fin_asociacion' => Carbon::now()
                        ]);
                    if ($resultado == 0) {
                        return response()->json(['No se ha actualizado correctamente'], 200);
                    } else if ($resultado == 1) {
                        return response()->json(['Se ha actualizado correctamente'], 200);

                    }

                }
            }
            throw new Exception("No existe esa nave asiganada a ese piloto con fecha no finalizada");

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 404);

        }


    }


    public function getNavesSinPiloto()
    {
        try {
            $navesSinPiloto = Nave::whereDoesntHave('pilotos')->get();
            return response()->json(['naves ' => $navesSinPiloto], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }


    public function getPilotosConNaveHistorico()
    {
        try {
            $pilotosConNaveHistorico = Piloto::with(['naves'])->has('naves')->get();
            return response()->json(['pilotos ' => $pilotosConNaveHistorico], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function getPilotosConNaveActual()
    {
        try {
            $pilotosConNaveActual = Nave_Piloto::with(['nave.pilotos'])->whereNull('fecha_fin_asociacion')->orWhere('fecha_fin_asociacion', '>', Carbon::now())->get();
            return response()->json(['pilotos ' => $pilotosConNaveActual], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }


    public function addMantenimiento(Request $req)
    {
        try {
            $mantenimiento = new Mantenimiento;
            $mantenimiento = $mantenimiento->create($req->all());
            return response()->json($mantenimiento, 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function listarMantenimientoPuntual()
    {
        try {
            $mantenimientos = Mantenimiento::where('fecha', '>=', Carbon::now()->subYear())->get();
            return response()->json(['mantenimientos ' => $mantenimientos], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function listarMantenimientosFechas($fecha1, $fecha2)
    {
        try {
            $mantenimientos = Mantenimiento::where('fecha', '>=', $fecha1)->where('fecha', '<=', $fecha2)->get();
            return response()->json(['mantenimientos ' => $mantenimientos], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function getNavesPilotos(){
        try {
            $navesPilotos = Nave_Piloto::with(['nave.planeta', 'piloto'])->get();
            return response()->json(['navesPilotos ' => $navesPilotos], 200);
        }catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function getPlaneta($id){
        try {
            $planeta = Planeta::findOrFail($id);
            return response()->json(['planeta ' => $planeta], 200);
        }catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function getPlanetas(){
        try {
            $planetas = Planeta::all();
            return response()->json(['planetas ' => $planetas], 200);
        }catch( \Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function getPiloto($id){
        try {
            $piloto = Piloto::findOrFail($id);
            return response()->json(['piloto ' => $piloto], 200);
        }catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function getPilotos(){
        try {
            $pilotos = Piloto::all();
            return response()->json(['pilotos ' => $pilotos], 200);
        }catch( \Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function getMantenimento($id){
        try {
            $mantenimiento = Mantenimiento::findOrFail($id);
            return response()->json(['mantenimiento ' => $mantenimiento], 200);
        }catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function getMantenimientos(){
        try {
            $mantenimientos = Mantenimiento::all();
            return response()->json(['mantenimientos ' => $mantenimientos], 200);
        }catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function getUsuario($id){
        try {
            $usuario = User::findOrFail($id);
            return response()->json(['usuario ' => $usuario], 200);
        }catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function getUsuarios(){
        try {
            $usuarios = User::all();
            return response()->json(['usuarios ' => $usuarios], 200);
        }catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }
}



