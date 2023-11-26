<?php

namespace App\Http\Controllers\Api;

use App\Models\Asignatura;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class asignaturaController extends Controller
{
    public function indexAsignaturas(){
        $asignaturas = Asignatura::all();
        if($asignaturas -> count() > 0){
            return response()->json([
                'status'=> '200',
                'asignaturas' => $asignaturas
            ], 200);
        }else{
            return response()->json([
                'status'=> '404',
                'message' => 'No se encontraron registros'
            ], 404);
        }
    }

    public function universidadAsignaturas(Request $request){
        $validator = Validator::make($request->all(), [ 
            'nombre' => 'required|string|max:191',
            'descripcion' => 'required|string|max:191',
            'creditos'=> 'required|string|max:2',
            'area' => 'required|string|max:191',
            'participacion' => 'required|string|max:191'
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => 422,
                    'errors' => $validator->messages()
                ], 422);
            }else{
                $asignatura = Asignatura::create([
                    'nombre' => $request->nombre,
                    'descripcion' => $request->descripcion,
                    'creditos'=> $request->creditos,
                    'area' => $request->area,
                    'participacion' => $request->participacion
                    ]);

                if($asignatura){
                    return response()->json([
                            'status' => 200,
                            'message' => 'Asignatura creada correctamente'
                    ], 200);
                }else{
                        return response()->json([
                            'status' => 500,
                            'message' => 'Algo salio mal'
                        ], 500);
                }
            }
    }

    public function showAsignaturas( $id ){
        $asignatura = Asignatura::find( $id );
        if( $asignatura ){
            return response()->json([
                'status' => 200,
                'asignatura' => $asignatura
        ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'la asignatura identificada con '.$id.' no esta registrada en la base de datos'
            ], 404);
        }
    }

    public function editAsignaturas( $id ){
        $asignatura = Asignatura::find( $id );
        if( $asignatura ){
            return response()->json([
                'status' => 200,
                'asignatura' => $asignatura
        ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'la asignatura identificado con '.$id.' no esta registrada en la base de datos'
            ], 404);
        }
    }

    public function updateAsignaturas(Request $request, $id){
        $validator = Validator::make($request->all(), [ 
            'nombre' => 'required|string|max:191',
            'descripcion' => 'required|string|max:191',
            'creditos'=> 'required|string|max:2',
            'area' => 'required|string|max:191',
            'participacion' => 'required|string|max:191'
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => 422,
                    'errors' => $validator->messages()
                ], 422);
            }else{

                $asignatura = Asignatura::find( $id );
                
                if($asignatura){
                    $asignatura->update([
                        'nombre' => $request->nombre,
                        'descripcion' => $request->descripcion,
                        'creditos'=> $request->creditos,
                        'area' => $request->area,
                        'participacion' => $request->participacion
                        ]);
    
                    return response()->json([
                            'status' => 200,
                            'message' => 'Asignatura actualizada correctamente'
                    ], 200);
                }else{
                        return response()->json([
                            'status' => 404,
                            'message' => 'Algo salio mal'
                        ], 404);
                }
            }        
    }

    public function destroyAsignaturas( $id ){
        $asignatura = Asignatura::find( $id );
        if($asignatura){
            $asignatura->delete();

            return response()->json([
                'status'=> 200,
                'message'=> 'Asignatura eliminada correctamente'
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Algo salio mal'
            ], 404);
        }
    }
}
