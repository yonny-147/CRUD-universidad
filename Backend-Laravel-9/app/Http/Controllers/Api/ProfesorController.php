<?php

namespace App\Http\Controllers\Api;

use App\Models\Profesor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class profesorController extends Controller
{
    public function indexProfesores(){
        $profesores = Profesor::all();
        if($profesores -> count() > 0){
            return response()->json([
                'status'=> '200',
                'profesores' => $profesores
            ], 200);
        }else{
            return response()->json([
                'status'=> '404',
                'message' => 'No se encontraron registros'
            ], 404);
        }
    }

    public function UniversidadProfesores(Request $request){
        $validator = Validator::make($request->all(), [ 
            'documento' => 'required|string|max:10',
            'nombres' => 'required|string|max:191',
            'telefono' => 'required|string|max:10',
            'email' => 'required|email|max:191',
            'direccion' => 'required|string|max:191',
            'ciudad' => 'required|string|max:191'
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => 422,
                    'errors' => $validator->messages()
                ], 422);
            }else{
                $profesor = Profesor::create([
                    'documento' => $request->documento,
                    'nombres' => $request->nombres,
                    'telefono' => $request->telefono,
                    'email' => $request->email,
                    'direccion' => $request->direccion,
                    'ciudad' => $request->ciudad
                    ]);

                if($profesor){
                    return response()->json([
                            'status' => 200,
                            'message' => 'Profesor creado correctamente'
                    ], 200);
                }else{
                        return response()->json([
                            'status' => 500,
                            'message' => 'Algo salio mal'
                        ], 500);
                }
            }
    }

    public function showProfesores( $id ){
        $profesor = Profesor::find( $id );
        if( $profesor ){
            return response()->json([
                'status' => 200,
                'profesor' => $profesor
        ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'El profesor identificado con '.$id.' no esta registrado en la base de datos'
            ], 404);
        }
    }

    public function editProfesores( $id ){
        $profesor = Profesor::find( $id );
        if( $profesor ){
            return response()->json([
                'status' => 200,
                'profesor' => $profesor
        ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'El profesor identificado con '.$id.' no esta registrado en la base de datos'
            ], 404);
        }
    }

    public function updateProfesores(Request $request, $id){
        $validator = Validator::make($request->all(), [ 
            'documento' => 'required|string|max:10',
            'nombres' => 'required|string|max:191',
            'telefono' => 'required|digits:10',
            'email' => 'required|email|max:191',
            'direccion' => 'required|string|max:191',
            'ciudad' => 'required|string|max:191'
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => 422,
                    'errors' => $validator->messages()
                ], 422);
            }else{

                $profesor = Profesor::find( $id );
                
                if($profesor){
                    $profesor->update([
                        'documento' => $request->documento,
                        'nombres' => $request->nombres,
                        'telefono' => $request->telefono,
                        'email' => $request->email,
                        'direccion' => $request->direccion,
                        'ciudad' => $request->ciudad
                        ]);
    
                    return response()->json([
                            'status' => 200,
                            'message' => 'Profesor actualizado correctamente'
                    ], 200);
                }else{
                        return response()->json([
                            'status' => 404,
                            'message' => 'Algo salio mal'
                        ], 404);
                }
            }        
    }

    public function destroyProfesores( $id ){
        $profesor = Profesor::find( $id );
        if($profesor){
            $profesor->delete();

            return response()->json([
                'status'=> 200,
                'message'=> 'Profesor eliminado correctamente'
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Algo salio mal'
            ], 404);
        }
    }
}
