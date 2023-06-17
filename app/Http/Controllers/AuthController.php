<?php

namespace App\Http\Controllers;

use App\Enums\IdEliminado;
use App\Enums\IdEstado;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;


class AuthController extends Controller
{

    public function register(Request $request)
    {

        $user = User::create([
            'usuario_user' => $request->username,
            'usuario_passwd' => Helpers::encryptPass($request->password)
        ]);

        return response()->json($user);
    }

    public function login(Request $request)
    {
        $User = User::where('usuario',$request->input('usuario') )
                    ->where('idEstado', IdEstado::Habilitado)
                    ->where('idEliminado',IdEliminado::NoEliminado)
                    ->get();

        if( !$User->isEmpty() ){

            if( !Hash::check( $request->input('clave'),$User->first()->clave ) ){
                return response()->json([
                    'data'=>[],
                    'message' => 'Contraseña incorrectas',
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
                            'idNivel' => $user->idNivel

                        ],
//                        'client' => $user->client ? $user->client()->first(['id','bussiness_name', 'first_name', 'last_name']) : null,
//                        'permissions' => $user->modules()->pluck('short_name')
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

        }else{

            return response()->json([
                'data'      => null,
                'message' => 'Usuario o contraseña incorrecta',
                'status' => Response::HTTP_NOT_FOUND
            ]);

        }

    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::user()->tokens()->revoke();
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
