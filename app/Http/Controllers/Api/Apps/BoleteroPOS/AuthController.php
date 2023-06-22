<?php

namespace App\Http\Controllers\Api\Apps\BoleteroPOS;

use App\Enums\IdEliminado;
use App\Enums\IdEstado;
use App\Models\TransporteInterprovincial\Destino;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;


class AuthController extends Controller
{

    public function login(Request $request)
    {
        try {

            if( !$request->has('usuario') ){
                return response()->json([
                    'data'      => null,
                    'message' => 'Debe ingresar el usuario',
                    'status' => Response::HTTP_BAD_REQUEST
                ]);
            }
            if( !$request->has('clave') ){
                return response()->json([
                    'data'      => null,
                    'message' => 'Debe ingresar la clave',
                    'status' => Response::HTTP_BAD_REQUEST
                ]);
            }
            if( !$request->has('placa') ){
                return response()->json([
                    'data'      => null,
                    'message' => 'Debe ingresar la placa',
                    'status' => Response::HTTP_BAD_REQUEST
                ]);
            }

            $Ousuario = User::where('usuario',$request->input('usuario') )
                ->where('idEstado', IdEstado::Habilitado)
                ->where('idEliminado',IdEliminado::NoEliminado)
                ->get();

            $Vehiculo = \App\Models\Administracion\Vehiculo::where('placa',$request->input('placa'))->get();

            if( $Vehiculo->isEmpty() ){
                return response()->json([
                    'data'      => null,
                    'message' => 'El vehiculo con la placa '. $request->input('placa') . ' no se encuentra registrado en el sistema.',
                    'status' => Response::HTTP_NOT_FOUND
                ]);
            }

            if( $Ousuario->isEmpty() ){
                return response()->json([
                    'data'      => null,
                    'message' => 'El usuario no se encuentra registrado en el sistema o se encuentra inhabilitado.',
                    'status' => Response::HTTP_NOT_FOUND
                ]);
            }

            $_vehiculo = $Vehiculo->first();
            $_usuario = $Ousuario->first();

            if( $_usuario->idCliente !== $_vehiculo->idCliente ){
                return response()->json([
                    'data'      => null,
                    'message' => 'El usuario y el vehiculo no se encuentran registrados en la misma empresa.',
                    'status' => Response::HTTP_NOT_FOUND
                ]);
            }


            if( !Hash::check( $request->input('clave'),$_usuario->clave ) ){
                return response()->json([
                    'data'=>[],
                    'message' => 'Contraseña incorrectas',
                    'status' => Response::HTTP_BAD_REQUEST
                ]);
            }

            if( Auth::loginUsingId( $Ousuario->first()->id ) ) {
                $usuario = Auth::user();
//                dd($Ousuario);
                $token = $usuario->createToken($usuario->usuario.'-'.now())->plainTextToken;

                return response()->json([
                    'data'=>[
                        'token' => [
                            'access' => $token,
                            'type' => 'Bearer'
                        ],
                        'usuario' => [
                            'id' => $usuario->id,
                            'usuario' => $usuario->usuario,
                            'nombres' => $usuario->nombres,
                            'apellidos' => $usuario->apellidos,
                            'correo' => $usuario->correo,
                            'idNivel' => $usuario->idNivel,
                            'idCliente' => $usuario->idCliente,
                            'nombreCliente' =>  $usuario->client ? $usuario->client()->first(['bussiness_name'])->bussiness_name : null,
                            'idVehiculo' => $_vehiculo->id,
                            'placaVehiculo' => $_vehiculo->placa,
                        ],
                        'destinos' => Destino::select(
                                                'id as idDestino',
                                                'nombre as destino',
                                                'precioBase as precio'
                                            )
                                            ->where('idCliente', $usuario->idCliente)
                                            ->where('idEstado',1)->get()
//                        '' => $Ousuario->client ? $Ousuario->client()->first(['id','bussiness_name', 'first_name', 'last_name']) : null,
//                        'permissions' => $Ousuario->modules()->pluck('short_name')
                    ],
                    'message' => null,
                    'status' => Response::HTTP_OK
                ]);
            }else{
                return response()->json([
                    'data'      => null,
                    'message'   => 'Usuario o contraseña incorrecta',
                    'status'    => Response::HTTP_NOT_FOUND
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'data'      => null,
                'message'   => $e->getMessage() . $e->getTraceAsString(),
                'status'    => Response::HTTP_BAD_REQUEST
            ]);
        }
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::user()->tokens()->delete();
            return response()->json([
                'data'      => null,
                'message'   => null,
                'status' => Response::HTTP_OK
            ]);
        }else{
            return response()->json([
                'data'      => null,
                'message'   => 'No tiene autorización para realizar dicho evento.',
                'status' => Response::HTTP_UNAUTHORIZED
            ]);
        }
    }

}
