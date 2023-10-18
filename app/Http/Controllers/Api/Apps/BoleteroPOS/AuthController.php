<?php

namespace App\Http\Controllers\Api\Apps\BoleteroPOS;

use App\Enums\EnumParametroConfiguracion;
use App\Enums\EnumPuntoVenta;
use App\Enums\IdEliminado;
use App\Enums\IdEstado;
use App\Enums\IdTipoComprobante;
use App\Models\User;
use App\Models\V2\Caja;
use App\Models\V2\ClienteConfiguracion;
use App\Models\V2\Destino;
use App\Models\V2\Pos;
use App\Models\V2\Ruta;
use App\Models\V2\TipoDocumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use MyCLabs\Enum\Enum;
use Symfony\Component\HttpFoundation\Response;


class AuthController extends Controller
{

    public function login(Request $request)
    {
        try {
            if( !$request->has('imei') ){
                return response()->json([
                    'data'      => null,
                    'error' => 'Debe ingresar el imei del pos',
                    'status' => Response::HTTP_BAD_REQUEST
                ]);
            }

            if( !$request->has('usuario') ){
                return response()->json([
                    'data'      => null,
                    'error' => 'Debe ingresar el usuario',
                    'status' => Response::HTTP_BAD_REQUEST
                ]);
            }
            if( !$request->has('clave') ){
                return response()->json([
                    'data'      => null,
                    'error' => 'Debe ingresar la clave',
                    'status' => Response::HTTP_BAD_REQUEST
                ]);
            }
            if( !$request->has('placa') ){
                return response()->json([
                    'data'      => null,
                    'error' => 'Debe ingresar la placa',
                    'status' => Response::HTTP_BAD_REQUEST
                ]);
            }

            /** @var null | Caja $OCaja */
            $OCaja = null;

            $EquipoPos = Pos::where('imei',$request->input('imei') )
                ->where('id_estado', IdEstado::Habilitado)
                ->where('id_eliminado',IdEliminado::NoEliminado)
                ->get();

            $Ousuario = User::where('usuario',$request->input('usuario') )
                ->where('id_estado', IdEstado::Habilitado)
                ->where('id_eliminado',IdEliminado::NoEliminado)
                ->get();

            $Vehiculo = \App\Models\Administracion\Vehiculo::where('placa',$request->input('placa'))
                ->where('id_estado', IdEstado::Habilitado)
                ->where('id_eliminado',IdEliminado::NoEliminado)
                ->get();

            $TiposComprobante = \App\Models\V2\TipoComprobante::where('bl_punto_venta', EnumPuntoVenta::Si)
                ->get();

            if( $EquipoPos->isEmpty() ){
                return response()->json([
                    'data'      => null,
                    'error' => 'El equipo Pos con imei '. $request->input('imei') . ' no se encuentra registrado en el sistema o se encuentra inhabilitado.',
                    'status' => Response::HTTP_NOT_FOUND
                ]);
            }else{
                $OCaja = Caja::where('id_pos', $EquipoPos->first()->id )
                    ->where('id_estado', IdEstado::Habilitado)
                    ->where('id_eliminado',IdEliminado::NoEliminado)
                    ->get();
            }

            if( $Vehiculo->isEmpty() ){
                return response()->json([
                    'data'      => null,
                    'error' => 'El vehiculo con la placa '. $request->input('placa') . ' no se encuentra registrado en el sistema o se encuentra inhabilitado.',
                    'status' => Response::HTTP_NOT_FOUND
                ]);
            }

            if( $Ousuario->isEmpty() ){
                return response()->json([
                    'data'      => null,
                    'error' => 'El usuario no se encuentra registrado en el sistema o se encuentra inhabilitado.',
                    'status' => Response::HTTP_NOT_FOUND
                ]);
            }

            if( is_null($OCaja) || $OCaja->isEmpty() ){
                return response()->json([
                    'data'      => null,
                    'error' => 'Falta asignar una caja para el POS',
                    'status' => Response::HTTP_NOT_FOUND
                ]);
            }

            if( $TiposComprobante->isEmpty() ){
                return response()->json([
                    'data'      => null,
                    'error' => 'Los tipos de comprobante no se encuentras registrados en el sistema.',
                    'status' => Response::HTTP_NOT_FOUND
                ]);
            }



            $_caja = $OCaja->first();
            $_equipopos = $EquipoPos->first();
            $_vehiculo = $Vehiculo->first();
            $_usuario = $Ousuario->first();
            $_tiposComprobante = $TiposComprobante;




            if( $_usuario->id_cliente !== $_vehiculo->id_cliente ){
                return response()->json([
                    'data'      => null,
                    'error' => 'El usuario y el vehiculo no pertenecen al mismo cliente.',
                    'status' => Response::HTTP_NOT_FOUND
                ]);
            }

            if( $_usuario->id_cliente !== $_equipopos->id_cliente ){
                return response()->json([
                    'data'      => null,
                    'error' => 'El usuario y el equipo pos no pertenecen al mismo cliente.',
                    'status' => Response::HTTP_NOT_FOUND
                ]);
            }

            if( $_usuario->id_cliente !== $_caja->id_cliente ){
                return response()->json([
                    'data'      => null,
                    'error' => 'El usuario y la caja no pertenecen al mismo cliente.',
                    'status' => Response::HTTP_NOT_FOUND
                ]);
            }


            if( !Hash::check( $request->input('clave'),$_usuario->clave ) ){
                return response()->json([
                    'data'=>[],
                    'error' => 'Contraseña incorrectas',
                    'status' => Response::HTTP_BAD_REQUEST
                ]);
            }

            if( Auth::loginUsingId( $Ousuario->first()->id ) ) {
                $usuario = Auth::user();
//                dd($Ousuario);
                $token = $usuario->createToken($usuario->usuario.'-'.now())->plainTextToken;


                $Configuracion = ClienteConfiguracion::select('valor')->where('id_cliente', $usuario->id_cliente)->where('id_parametro_configuracion',EnumParametroConfiguracion::Empresa_Ruc->value)->get();

                return response()->json([
                    'data'=>[
                        'token' => [
                            'access' => $token,
                            'type' => 'Bearer'
                        ],
                        'tiposComprobante' => $_tiposComprobante->map(function($tc, $key) use ($_vehiculo) {

                            $serieLetra = '';
                            switch ( $tc->id ){
                                case IdTipoComprobante::Boleta->value: $serieLetra = 'B'; break;
                                case IdTipoComprobante::Factura->value: $serieLetra = 'F'; break;
                                case IdTipoComprobante::Ticket->value: $serieLetra = 'T'; break;
                                default: $serieLetra = 'B'; break;
                            }

                            return [
                                'id' => $tc->id,
                                'nombre' => $tc->nombre,
                                'serie' => $serieLetra . str_pad($_vehiculo->codigo,3,'0',STR_PAD_LEFT),
                            ];
                        }),
                        'usuario' => [
                            'id' => $usuario->id,
                            'usuario' => $usuario->usuario,
                            'nombres' => $usuario->nombres,
                            'apellidos' => $usuario->apellidos,
                            'correo' => $usuario->correo,
                            'idNivel' => $usuario->id_nivel
                        ],
                        'cliente' => [
                            'id' => $usuario->id_cliente,
                            'codigo' => str_pad($usuario->cliente->codigo,2,'0',STR_PAD_LEFT),
                            'nombre' =>  $usuario->cliente->nombre,
                            'numeroDocumento' =>  !$Configuracion->isEmpty() ? (int)$Configuracion->first()->valor : ''
                        ],
                        'vehiculo' => [
                            'id' => $_vehiculo->id,
                            'codigo' => str_pad($_vehiculo->codigo,3,'0',STR_PAD_LEFT),
                            'placa' => $_vehiculo->placa,
                        ],
                        'rutas' => Ruta::with('paraderos:id,id_ruta,id_paradero_origen,id_paradero_destino,precio_base')->select(
                                'id',
                                'nombre'
                            )
                            ->where('id_cliente', $usuario->id_cliente)
                            ->where('id_estado',1)->get()->map(function ($v) {

                            return [
                                'id' => $v->id,
                                'nombre' => $v->nombre,
                                'paraderos' => $v->paraderos->map(function ($p) {
                                    return [
                                        'id' => $p->id,
                                        'idRuta' => $p->id_ruta,
//                                        'idParaderoOrigen' => $p->id_paradero_origen,
//                                        'idParaderoDestino' => $p->id_paradero_destino,
                                        'precioBase' => $p->precio_base,
                                        'nombre' => $p->paraderoOrigen->nombre . ' - ' . $p->paraderoDestino->nombre
                                    ];
                                })
                            ];

                        }),
                        'caja' => [
                            'id' => $_caja->id,
                            'nombre' => $_caja->nombre
                        ],
                        'pos' => [
                            'id' => $_equipopos->id,
                            'nombre' => $_equipopos->nombre
                        ],
                        'tiposDocumento' => TipoDocumento::all()
//                        '' => $Ousuario->client ? $Ousuario->client()->first(['id','bussiness_name', 'first_name', 'last_name']) : null,
//                        'permissions' => $Ousuario->modules()->pluck('short_name')
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
        }catch(\Exception $e){
            return response()->json([
                'data'      => null,
                'error'   => $e->getMessage() . $e->getTraceAsString(),
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
    }

}
