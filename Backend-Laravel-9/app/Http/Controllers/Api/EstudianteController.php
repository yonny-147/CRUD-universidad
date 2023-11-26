<?php

namespace App\Http\Controllers\Api;

use App\Models\Estudiante;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class estudianteController extends Controller
{
    public function index(){
        $estudiantes = Estudiante::all();
        if($estudiantes -> count() > 0){
            return response()->json([
                'status'=> '200',
                'estudiantes' => $estudiantes
            ], 200);
        }else{
            return response()->json([
                'status'=> '404',
                'message' => 'No se encontraron registros'
            ], 404);
        }
    }

    public function universidad(Request $request){
        $validator = Validator::make($request->all(), [ 
            'documento' => 'required|string|max:10',
            'nombres' => 'required|string|max:191',
            'telefono' => 'required|string|max:10',
            'email' => 'required|email|max:191',
            'direccion' => 'required|string|max:191',
            'ciudad' => 'required|string|max:191',
            'semestre' => 'required|string|max:2'
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => 422,
                    'errors' => $validator->messages()
                ], 422);
            }else{
                $estudiante = Estudiante::create([
                    'documento' => $request->documento,
                    'nombres' => $request->nombres,
                    'telefono' => $request->telefono,
                    'email' => $request->email,
                    'direccion' => $request->direccion,
                    'ciudad' => $request->ciudad,
                    'semestre' => $request->semestre
                    ]);

                if($estudiante){
                    return response()->json([
                            'status' => 200,
                            'message' => 'Estudiante creado correctamente'
                    ], 200);
                }else{
                        return response()->json([
                            'status' => 500,
                            'message' => 'Algo salio mal'
                        ], 500);
                }
            }
    }

    public function show( $id ){
        $estudiante = Estudiante::find( $id );
        if( $estudiante ){
            return response()->json([
                'status' => 200,
                'estudiante' => $estudiante
        ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'El estudiante identificado con '.$id.' no esta registrado en la base de datos'
            ], 404);
        }
    }

    public function edit( $id ){
        $estudiante = Estudiante::find( $id );
        if( $estudiante ){
            return response()->json([
                'status' => 200,
                'estudiante' => $estudiante
        ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'El estudiante identificado con '.$id.' no esta registrado en la base de datos'
            ], 404);
        }
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [ 
            'documento' => 'required|string|max:10',
            'nombres' => 'required|string|max:191',
            'telefono' => 'required|string|max:10',
            'email' => 'required|email|max:191',
            'direccion' => 'required|string|max:191',
            'ciudad' => 'required|string|max:191',
            'semestre' => 'required|string|max:2'
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => 422,
                    'errors' => $validator->messages()
                ], 422);
            }else{

                $estudiante = Estudiante::find( $id );
                
                if($estudiante){
                    $estudiante->update([
                        'documento' => $request->documento,
                        'nombres' => $request->nombres,
                        'telefono' => $request->telefono,
                        'email' => $request->email,
                        'direccion' => $request->direccion,
                        'ciudad' => $request->ciudad,
                        'semestre' => $request->semestre
                        ]);
    
                    return response()->json([
                            'status' => 200,
                            'message' => 'Estudiante actualizado correctamente'
                    ], 200);
                }else{
                        return response()->json([
                            'status' => 404,
                            'message' => 'Algo salio mal'
                        ], 404);
                }
            }        
    }

    public function destroy( $id ){
        $estudiante = Estudiante::find( $id );
        if($estudiante){
            $estudiante->delete();

            return response()->json([
                'status'=> 200,
                'message'=> 'Estudiante eliminado correctamente'
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Algo salio mal'
            ], 404);
        }
    }
}
