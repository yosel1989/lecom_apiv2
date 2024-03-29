<?php

namespace App\Http\Controllers\Api\V2;

use App\Enums\IdEliminado;
use App\Enums\IdEstado;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\V2\Sede;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;


class AuthController extends Controller
{

    public function login(Request $request)
    {
        $User = User::where('usuario',$request->input('usuario') )
                    ->where('id_estado', IdEstado::Habilitado)
                    ->where('id_eliminado',IdEliminado::NoEliminado)
                    ->get();

        if( !$User->isEmpty() ){

            if( !Hash::check( $request->input('clave'),$User->first()->clave ) ){
                return response()->json([
                    'data'=>[],
                    'error' => 'Contraseña incorrecta.',
                    'status' => Response::HTTP_BAD_REQUEST
                ]);
            }

            if( Auth::loginUsingId( $User->first()->id ) ) {
                $user = Auth::user();
//                dd($user);
                $token = $user->createToken($user->usuario.'-'.now())->plainTextToken;

                return response()->json([
                    'data'=>[
                        'token' => [
                            'access' => $token,
                            'type' => 'Bearer'
                        ],
                        'usuario' => [
                            'id' => $user->id,
                            'usuario' => $user->usuario,
                            'nombres' => $user->nombres,
                            'apellidos' => $user->apellidos,
                            'correo' => $user->correo,
                            'idNivel' => $user->id_nivel,
                            'idPerfil' => $user->id_perfil,
                            'perfil' => $user->id_perfil ? $user->perfil->nombre : null,
                            'idEstado' => $user->idEstado,
                            'idCliente' => $user->id_cliente,
                            'cliente' => $user->id_cliente ? $user->cliente->nombre : null,
                            'idSede' => $user->personal ? $user->personal->id_sede : null,
                            'sede' => $user->personal ? Sede::findOrFail($user->personal->id_sede)->nombre : null,
                        ],
//                        'client' => $user->client ? $user->client()->first(['id','bussiness_name', 'first_name', 'last_name']) : null,
//                        'permissions' => $user->modules()->pluck('short_name')
                    ],
                    'error' => null,
                    'status' => Response::HTTP_OK
                ]);
            }else{
                return response()->json([
                    'data'      => null,
                    'error'   => 'Usuario o contraseña incorrecta',
                    'status'    => Response::HTTP_NOT_FOUND
                ]);
            }

        }else{

            return response()->json([
                'data'      => null,
                'error' => 'El usuario no se encuentra registrado en el sistema.',
                'status' => Response::HTTP_NOT_FOUND
            ]);

        }

    }

    public function logout()
    {
        try {
            if (Auth::user()) {
                Auth::user()->tokens()->delete();
                return response()->json([
                    'data'      => null,
                    'error'   => null,
                    'status' => Response::HTTP_OK
                ]);
            }else{
                return response()->json([
                    'data'      => null,
                    'error'   => 'No tiene autorización para realizar dicho evento.',
                    'status' => Response::HTTP_UNAUTHORIZED
                ]);
            }
        }catch (Exception $e){
            return response()->json([
                'data'      => null,
                'error'   => 'Ocurrio un error al intentar cerrar sesión',
                'status' => Response::HTTP_UNAUTHORIZED
            ]);
        }

    }

}
