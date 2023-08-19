<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;


Route::namespace('App\Http\Controllers\Api\V2\BoletoInterprovincial')->middleware('auth:sanctum')->group( function (){
    Route::get('cliente/{id}/boleto-interprovincial', 'GetCollectionByClienteController');
    Route::post('boleto-interprovincial/{id}/cambiar-estado', 'ChangeStateController');
    Route::get('boleto-interprovincial/{id}', 'FindByIdController');


    Route::get('cliente/{id}/{fechaDesde}/{fechaHasta}/boleto-interprovincial/reporte', 'GetReportByClienteController');
    Route::get('cliente/{id}/boleto-interprovincial/reporte-punto-venta/sede/{idSede}', 'GetReportePuntoVentaByClienteController');
    Route::post('cliente/{id}/boleto-interprovincial/punto-venta', 'PuntoVentaController');
});




Route::middleware('auth:sanctum')->group(function() {
    Route::post('app/{idCliente}/boleto-pos', function(Request $request){


        $nombres = $request->has('nombres') ? $request->input('nombres') : null;
        $apellidos = $request->has('apellidos') ? $request->input('apellidos') : null;



        $idTipoComprobante = $request->has('idTipoComprobante') ? (int)$request->input('idTipoComprobante') : null;
        $serieComprobante = $request->has('serieComprobante') ? $request->input('serieComprobante') : null;
        $numeroComprobante = $request->has('numeroComprobante') ? (int)$request->input('numeroComprobante') : null;
        $idTipoBoleto = $request->has('idTipoBoleto') ? (int)$request->input('idTipoBoleto') : \App\Enums\IdTipoBoleto::VentaBoleto->value;


        $porPagar = $request->has('porPagar') ? (int)$request->input('porPagar') : 0;


        try {
            $user = Auth::user();

            /** @var \App\Models\V2\Cliente | null $_cliente */
            $_cliente = null;
            /** @var \App\Models\V2\Vehiculo | null $_vehiculo */
            $_vehiculo = null;
            /** @var \App\Models\V2\Ruta | null $_ruta */
            $_ruta = null;
            /** @var \App\Models\V2\Paradero | null $_paradero */
            $_paradero = null;
            /** @var \App\Models\V2\Caja | null $_caja */
            $_caja = null;
            /** @var \App\Models\V2\Pos | null $_pos */
            $_pos = null;

            $Cliente = \App\Models\V2\Cliente::where('id', $request->idCliente)->where('idEstado',1)->where('idEliminado',0)->get();
            if( $Cliente->isEmpty() ){
                return response()->json([
                    'data'      => null,
                    'error' => 'El cliente no se encuentra registrado en el sistema o esta inhabilitado.',
                    'status' => Response::HTTP_NOT_FOUND
                ]);
            }
            $_cliente = $Cliente->first();


            $Vehiculo = \App\Models\V2\Vehiculo::where('id', $request->input('idVehiculo'))
                ->where('idEstado',1)
                ->where('idEliminado',0)
                ->where('idCliente',$_cliente->id)
                ->get();
            if( $Vehiculo->isEmpty() ){
                return response()->json([
                    'data'      => null,
                    'error' => 'El vehiculo no se encuentra registrado en el sistema o esta inhabilitado.',
                    'status' => Response::HTTP_NOT_FOUND
                ]);
            }
            $_vehiculo = $Vehiculo->first();



            $Ruta = \App\Models\V2\Ruta::where('id', $request->input('idRuta'))
                ->where('idEstado',1)
                ->where('idEliminado',0)
                ->where('idCliente',$_cliente->id)
                ->get();
            if( $Ruta->isEmpty() ){
                return response()->json([
                    'data'      => null,
                    'error' => 'La ruta no se encuentra registrado en el sistema o esta inhabilitado.',
                    'status' => Response::HTTP_NOT_FOUND
                ]);
            }
            $_ruta = $Ruta->first();



            $Paradero = \App\Models\V2\Paradero::where('id', $request->input('idParadero'))
                ->where('idEstado',1)
                ->where('idEliminado',0)
                ->where('idCliente',$_cliente->id)
                ->get();
            if( $Paradero->isEmpty() ){
                return response()->json([
                    'data'      => null,
                    'error' => 'El paradero se encuentra registrado en el sistema o esta inhabilitado.',
                    'status' => Response::HTTP_NOT_FOUND
                ]);
            }
            $_paradero = $Paradero->first();


            $Caja  = \App\Models\V2\Caja::where('id', $request->input('idCaja'))
                ->where('idEstado',1)
                ->where('idEliminado',0)
                ->where('idCliente',$_cliente->id)
                ->get();
            if( $Caja->isEmpty() ){
                return response()->json([
                    'data'      => null,
                    'error' => 'La caja no se encuentra registrado en el sistema o esta inhabilitado.',
                    'status' => Response::HTTP_NOT_FOUND
                ]);
            }
            $_caja = $Caja->first();

            $Pos  = \App\Models\V2\Pos::where('id', $request->input('idPos'))
                ->where('idEstado',1)
                ->where('idEliminado',0)
                ->where('idCliente',$_cliente->id)
                ->get();
            if( $Pos->isEmpty() ){
                return response()->json([
                    'data'      => null,
                    'error' => 'El equipo POS no se encuentra registrado en el sistema o esta inhabilitado.',
                    'status' => Response::HTTP_NOT_FOUND
                ]);
            }
            $_pos = $Pos->first();

            /******* Verificar que el paradero insertado pertenece a la ruta ******************/
            if($_paradero->idRuta !== $_ruta->id){
                return response()->json([
                    'data'      => null,
                    'error' => 'El paradero '. $_paradero->nombre .' no esta asignado a la ruta ' . $_ruta->nombre,
                    'status' => Response::HTTP_NOT_FOUND
                ]);
            }
            /******* Verificar que que la caja insertada pertenece al equipo POS ******************/
            if($_caja->idPos !== $_pos->id){
                return response()->json([
                    'data'      => null,
                    'error' => 'La caja ' . $_caja->nombre . ' no esta asignada al Equipo POS ' . $_pos->nombre,
                    'status' => Response::HTTP_NOT_FOUND
                ]);
            }


            if (!Schema::hasTable('boleto_interprovincial_' . $_cliente->codigo)) {
                DB::statement("CREATE TABLE boleto_interprovincial_' . $_cliente->codigo . ' LIKE boleto_interprovincial_base");

//                Schema::create('boleto_interprovincial_' . $_cliente->codigo, function (Blueprint $table) {
//                    $table->uuid('id')->unique()->primary();
//                    $table->uuid('idRuta')->nullable();
//                    $table->uuid('idParadero')->nullable();
//                    $table->uuid('idVehiculo')->nullable();
//                    $table->uuid('idCaja')->nullable();
//                    $table->uuid('idPos')->nullable();
//                    $table->uuid('idCliente')->nullable();
//                    $table->smallInteger('idTipoDocumento')->nullable();
//                    $table->string('numeroDocumento',20)->nullable();
//                    $table->string('nombre',250)->nullable();
//                    $table->string('direccion',250)->nullable();
//                    $table->string('codigoBoleto',30)->nullable();
//                    $table->decimal('latitud',10,8)->nullable();
//                    $table->decimal('longitud',10,8)->nullable();
//                    $table->decimal('precio',5,2);
//                    $table->dateTime('fecha');
//                    $table->tinyInteger('idEstado')->default(1);
//                    $table->tinyInteger('idEliminado')->default(0);
//                    $table->tinyInteger('anulado')->default(0);
//                    $table->tinyInteger('enBlanco')->default(0);
//                    $table->uuid('idUsuarioRegistro');
//                    $table->uuid('idUsuarioModifico')->nullable();
//                    $table->timestamp('fechaRegistro');
//                    $table->timestamp('fechaModifico')->nullable();
//                });
            }

            $model = new \App\Models\V2\BoletoInterprovincial();
            $model->setTable('boleto_interprovincial_' . $Cliente->first()->codigo);

            $model->create([
                'idCliente' => $request->idCliente,
                'idRuta' => $request->input('idRuta'),
                'idParadero' => $request->input('idParadero'),
                'idVehiculo' => $request->input('idVehiculo'),
                'idCaja' => $request->input('idCaja'),
                'idPos' => $request->input('idPos'),

                'precio' => $request->input('precio'),
                'fecha' => $request->input('fecha'),
                'codigoBoleto' => $request->input('codigoBoleto'),
                'latitud' => $request->input('latitud'),
                'longitud' => $request->input('longitud'),
                'enBlanco' => $request->input('enBlanco'),
                'idUsuarioRegistro' => $user->getId(),

                // ruc

                'idTipoDocumento' => $request->input('idTipoDocumento'),
                'numeroDocumento' => $request->input('numeroDocumento'),
                'nombre' => $request->input('nombre'),
                'direccion' => $request->input('direccion'),

                // pasajero


                'nombres' => $nombres,
                'apellidos' => $apellidos,


                'idTipoComprobante' => $idTipoComprobante,
                'serieComprobante' => $serieComprobante,
                'numeroComprobante' => $numeroComprobante,

                'idPorPagar' => $porPagar,
                'idTipoBoleto' => $idTipoBoleto,

            ]);

            return response()->json([
                'data' => null,
                'error' => null,
                'status' => Response::HTTP_CREATED
            ]);
        }catch ( InvalidArgumentException | Exception $e ){
            return response()->json([
                'data' => null,
                'error' => $e->getMessage(),
                'status' => Response::HTTP_BAD_REQUEST
            ]);
        }

    });
});
