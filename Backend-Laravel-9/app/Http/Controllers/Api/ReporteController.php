<?php

namespace App\Http\Controllers\Api;

use App\Models\Reporte;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class reporteController extends Controller
{
    public function indexReportes(){
        $reportes = Reporte::all();
        if($reportes -> count() > 0){
            return response()->json([
                'status'=> '200',
                'reportes' => $reportes
            ], 200);
        }else{
            return response()->json([
                'status'=> '404',
                'message' => 'No se encontraron reportes'
            ], 404);
        }
    }

    public function UniversidadReportes(Request $request){
        $validator = Validator::make($request->all(), [ 
            'estudiante' => 'required|string|max:191',
            'profesor' => 'required|string|max:191',
            'asignatura' => 'required|string|max:191'
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => 422,
                    'errors' => $validator->messages()
                ], 422);
            }else{
                $reporte = Reporte::create([
                    'estudiante' => $request->estudiante,
                    'profesor' => $request->profesor,
                    'asignatura' => $request->asignatura,
                    ]);

                if($reporte){
                    return response()->json([
                            'status' => 200,
                            'message' => 'Reporte creado correctamente'
                    ], 200);
                }else{
                    return response()->json([
                        'status' => 500,
                        'message' => 'Algo salio mal'
                    ], 500);
                }
            }
    }

    public function showReportes( $id ){
        $reporte = Reporte::find( $id );
        if( $reporte ){
            return response()->json([
                'status' => 200,
                'reporte' => $reporte
        ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'El reporte identificado con '.$id.' no esta registrado en la base de datos'
            ], 404);
        }
    }

    public function editReportes( $id ){
        $reporte = Reporte::find( $id );
        if( $reporte ){
            return response()->json([
                'status' => 200,
                'reporte' => $reporte
        ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'El reporte identificado con '.$id.' no esta registrado en la base de datos'
            ], 404);
        }
    }

    public function updateReportes(Request $request, $id){
        $validator = Validator::make($request->all(), [ 
            'estudiante' => 'required|string|max:191',
            'profesor' => 'required|string|max:191',
            'asignatura' => 'required|string|max:191'
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => 422,
                    'errors' => $validator->messages()
                ], 422);
            }else{

                $reporte = Reporte::find( $id );
                
                if($reporte){
                    $reporte->update([
                        'estudiante' => $request->estudiante,
                        'profesor' => $request->profesor,
                        'asignatura' => $request->asignatura,
                        ]);
    
                    return response()->json([
                            'status' => 200,
                            'message' => 'Reporte actualizado correctamente'
                    ], 200);
                }else{
                        return response()->json([
                            'status' => 404,
                            'message' => 'Algo salio mal'
                        ], 404);
                }
            }        
    }

    public function destroyReportes( $id ){
        $reporte = Reporte::find( $id );
        if($reporte){
            $reporte->delete();

            return response()->json([
                'status'=> 200,
                'message'=> 'Reporte eliminado correctamente'
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Algo salio mal'
            ], 404);
        }
    }
}
