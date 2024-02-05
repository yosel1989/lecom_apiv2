<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;


Route::namespace('App\Http\Controllers\Api\V2\BoletoInterprovincial')->middleware('auth:sanctum')->group( function (){
    Route::get('cliente/{id}/boleto-interprovincial', 'GetCollectionByClienteController');
    Route::post('boleto-interprovincial/{id}/cambiar-estado', 'ChangeStateController');
    Route::put('boleto-interprovincial/scan', 'ScanByIdController');
    Route::put('boleto-interprovincial/traslado', 'ScanByIdController');
    Route::get('boleto-interprovincial/{id}/{idCliente}', 'FindByIdController');
    Route::get('boleto-interprovincial/show/{id}/{idCliente}', 'ShowByIdController');

    Route::get('cliente/{id}/boleto-interprovincial/reporte-venta/{fechaDesde}/{fechaHasta}/{idRuta}', 'GetReportByClienteController');
    Route::get('cliente/{id}/usuario/boleto-interprovincial/reporte-venta/{fechaDesde}/{fechaHasta}/{idRuta}', 'GetReportByUsuarioClienteController');

    Route::post('cliente/boleto-interprovincial/reporte-total', 'GetReportTotalByClienteController');
    Route::post('cliente/boleto-interprovincial/reporte-total/vehiculo', 'GetReporteTotalByVehiculoRangoFechaController');
    Route::post('cliente/boleto-interprovincial/reporte/vehiculo', 'GetReporteTotalByVehiculoFechaController');

    Route::get('cliente/{id}/boleto-interprovincial/reporte-punto-venta/usuario', 'GetReportePuntoVentaByClienteController');
    Route::post('cliente/{id}/boleto-interprovincial/punto-venta', 'PuntoVentaController');

    Route::post('cliente/boleto-interprovincial/reporte/lista-pasajeros', 'GetPasajerosByVehiculoRangoFechaController');
});

//Route::namespace('App\Http\Controllers\Api\V2\BoletoInterprovincial')->group( function (){
//    Route::get('cliente/{id}/boleto-interprovincial/punto-venta', 'PuntoVentaController');
//});

Route::middleware('auth:sanctum')->group(function() {
//    Route::post('app/{idCliente}/boleto-pos', function(Request $request){
//
//        $nombres = $request->has('nombres') ? $request->input('nombres') : null;
//        $apellidos = $request->has('apellidos') ? $request->input('apellidos') : null;
//
//        $idTipoComprobante = $request->has('idTipoComprobante') ? (int)$request->input('idTipoComprobante') : null;
//        $serieComprobante = $request->has('serieComprobante') ? $request->input('serieComprobante') : null;
//        $numeroComprobante = $request->has('numeroComprobante') ? (int)$request->input('numeroComprobante') : null;
//        $idTipoBoleto = $request->has('idTipoBoleto') ? (int)$request->input('idTipoBoleto') : \App\Enums\IdTipoBoleto::VentaBoleto->value;
//
//        $porPagar = $request->has('porPagar') ? (int)$request->input('porPagar') : 0;
//
//        try {
//            $user = Auth::user();
//
//            /** @var \App\Models\V2\Cliente | null $_cliente */
//            $_cliente = null;
//            /** @var \App\Models\V2\Vehiculo | null $_vehiculo */
//            $_vehiculo = null;
//            /** @var \App\Models\V2\Ruta | null $_ruta */
//            $_ruta = null;
//            /** @var \App\Models\V2\Paradero | null $_paradero */
//            $_paradero = null;
//            /** @var \App\Models\V2\Caja | null $_caja */
//            $_caja = null;
//            /** @var \App\Models\V2\Pos | null $_pos */
//            $_pos = null;
//
//            $Cliente = \App\Models\V2\Cliente::where('id', $request->idCliente)->where('idEstado',1)->where('idEliminado',0)->get();
//            if( $Cliente->isEmpty() ){
//                \App\Models\V2\LogBoletoInterprovincial::create([ 'id_cliente' => $request->idCliente,
//                    'motivo' => 'Error cliente',
//                    'descripcion' => 'El id ' . $request->idCliente . ' no se encuentra registrado o el cliente se encuentra inhabilitado.'
//                ]);
//                return response()->json([
//                    'data'      => null,
//                    'error' => 'El cliente no se encuentra registrado en el sistema o esta inhabilitado.',
//                    'status' => Response::HTTP_NOT_FOUND
//                ],200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
//            }
//            $_cliente = $Cliente->first();
//
//
//            $Vehiculo = \App\Models\V2\Vehiculo::where('id', $request->input('idVehiculo'))
//                ->where('idEstado',1)
//                ->where('idEliminado',0)
//                ->where('idCliente',$_cliente->id)
//                ->get();
//            if( $Vehiculo->isEmpty() ){
//                \App\Models\V2\LogBoletoInterprovincial::create([ 'id_cliente' => $request->idCliente,
//                    'motivo' => 'Error vehiculo',
//                    'descripcion' => 'El id ' . $request->input('idVehiculo') . ' no se encuentra registrado o el vehiculo se encuentra inhabilitado.'
//                ]);
//                return response()->json([
//                    'data'      => null,
//                    'error' => 'El vehiculo no se encuentra registrado en el sistema o esta inhabilitado.',
//                    'status' => Response::HTTP_NOT_FOUND
//                ],200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
//            }
//            $_vehiculo = $Vehiculo->first();
//
//
//
//            $Ruta = \App\Models\V2\Ruta::where('id', $request->input('idRuta'))
//                ->where('idEstado',1)
//                ->where('idEliminado',0)
//                ->where('idCliente',$_cliente->id)
//                ->get();
//            if( $Ruta->isEmpty() ){
//                \App\Models\V2\LogBoletoInterprovincial::create([ 'id_cliente' => $request->idCliente,
//                    'motivo' => 'Error ruta',
//                    'descripcion' => 'El id ' . $request->input('idRuta') . ' no se encuentra registrada o la ruta se encuentra inhabilitada.'
//                ]);
//                return response()->json([
//                    'data'      => null,
//                    'error' => 'La ruta no se encuentra registrado en el sistema o esta inhabilitado.',
//                    'status' => Response::HTTP_NOT_FOUND
//                ],200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
//            }
//            $_ruta = $Ruta->first();
//
//
//
//            $Paradero = \App\Models\V2\BoletoPrecio::where('id', $request->input('idParadero'))
//                ->where('idEstado',1)
//                ->where('idEliminado',0)
//                ->where('idCliente',$_cliente->id)
//                ->get();
//            if( $Paradero->isEmpty() ){
//                \App\Models\V2\LogBoletoInterprovincial::create([ 'id_cliente' => $request->idCliente,
//                    'motivo' => 'Error Boleto Precio',
//                    'descripcion' => 'El id ' . $request->input('idParadero') . ' no se encuentra registrada o el precio del boleto se encuentra inhabilitada.'
//                ]);
//                return response()->json([
//                    'data'      => null,
//                    'error' => 'El viaje no se encuentra registrado en el sistema o esta inhabilitado.',
//                    'status' => Response::HTTP_NOT_FOUND
//                ],200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
//            }
//            $_paradero = $Paradero->first();
//
//
//            $Caja  = \App\Models\V2\Caja::where('id', $request->input('idCaja'))
//                ->where('idEstado',1)
//                ->where('idEliminado',0)
//                ->where('idCliente',$_cliente->id)
//                ->get();
//            if( $Caja->isEmpty() ){
//                \App\Models\V2\LogBoletoInterprovincial::create([ 'id_cliente' => $request->idCliente,
//                    'motivo' => 'Error Caja',
//                    'descripcion' => 'El id ' . $request->input('idCaja') . ' no se encuentra registrada o la caja se encuentra inhabilitada.'
//                ]);
//                return response()->json([
//                    'data'      => null,
//                    'error' => 'La caja no se encuentra registrado en el sistema o esta inhabilitado.',
//                    'status' => Response::HTTP_NOT_FOUND
//                ],200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
//            }
//            $_caja = $Caja->first();
//
//            $Pos  = \App\Models\V2\Pos::where('id', $request->input('idPos'))
//                ->where('idEstado',1)
//                ->where('idEliminado',0)
//                ->where('idCliente',$_cliente->id)
//                ->get();
//            if( $Pos->isEmpty() ){
//                \App\Models\V2\LogBoletoInterprovincial::create([ 'id_cliente' => $request->idCliente,
//                    'motivo' => 'Error POS',
//                    'descripcion' => 'El id ' . $request->input('idPos') . ' no se encuentra registrada o el POS se encuentra inhabilitada.'
//                ]);
//                return response()->json([
//                    'data'      => null,
//                    'error' => 'El equipo POS no se encuentra registrado en el sistema o esta inhabilitado.',
//                    'status' => Response::HTTP_NOT_FOUND
//                ],200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
//            }
//            $_pos = $Pos->first();
//
//            /******* Verificar que el paradero insertado pertenece a la ruta ******************/
//            if($_paradero->idRuta !== $_ruta->id){
//                \App\Models\V2\LogBoletoInterprovincial::create([ 'id_cliente' => $request->idCliente,
//                    'motivo' => 'Error viaje',
//                    'descripcion' => 'El viaje '. $_paradero->paraderoOrigen->nombre . ' - ' . $_paradero->paraderoDestino->nombre .' no esta registrado en la ruta ' . $_ruta->nombre
//                ]);
//                return response()->json([
//                    'data'      => null,
//                    'error' => 'El viaje '. $_paradero->paraderoOrigen->nombre . ' - ' . $_paradero->paraderoDestino->nombre .' no esta registrado en la ruta ' . $_ruta->nombre,
//                    'status' => Response::HTTP_NOT_FOUND
//                ],200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
//            }
//            /******* Verificar que que la caja insertada pertenece al equipo POS ******************/
//            if($_caja->idPos !== $_pos->id){
//                \App\Models\V2\LogBoletoInterprovincial::create([ 'id_cliente' => $request->idCliente,
//                    'motivo' => 'Error Caja',
//                    'descripcion' => 'La caja ' . $_caja->nombre . ' no esta asignada al Equipo POS ' . $_pos->nombre,
//                ]);
//                return response()->json([
//                    'data'      => null,
//                    'error' => 'La caja ' . $_caja->nombre . ' no esta asignada al Equipo POS ' . $_pos->nombre,
//                    'status' => Response::HTTP_NOT_FOUND
//                ],200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
//            }
//
//
//            if (!Schema::hasTable('boleto_interprovincial_' . $_cliente->codigo)) {
//                DB::statement("CREATE TABLE boleto_interprovincial_cliente_' . $_cliente->codigo . ' LIKE boleto_interprovincial_base");
//
////                Schema::create('boleto_interprovincial_' . $_cliente->codigo, function (Blueprint $table) {
////                    $table->uuid('id')->unique()->primary();
////                    $table->uuid('idRuta')->nullable();
////                    $table->uuid('idParadero')->nullable();
////                    $table->uuid('idVehiculo')->nullable();
////                    $table->uuid('idCaja')->nullable();
////                    $table->uuid('idPos')->nullable();
////                    $table->uuid('idCliente')->nullable();
////                    $table->smallInteger('idTipoDocumento')->nullable();
////                    $table->string('numeroDocumento',20)->nullable();
////                    $table->string('nombre',250)->nullable();
////                    $table->string('direccion',250)->nullable();
////                    $table->string('codigoBoleto',30)->nullable();
////                    $table->decimal('latitud',10,8)->nullable();
////                    $table->decimal('longitud',10,8)->nullable();
////                    $table->decimal('precio',5,2);
////                    $table->dateTime('fecha');
////                    $table->tinyInteger('idEstado')->default(1);
////                    $table->tinyInteger('idEliminado')->default(0);
////                    $table->tinyInteger('anulado')->default(0);
////                    $table->tinyInteger('enBlanco')->default(0);
////                    $table->uuid('idUsuarioRegistro');
////                    $table->uuid('idUsuarioModifico')->nullable();
////                    $table->timestamp('fechaRegistro');
////                    $table->timestamp('fechaModifico')->nullable();
////                });
//            }
//
//            $model = new \App\Models\V2\BoletoInterprovincial();
//            $model->setTable('boleto_interprovincial_' . $Cliente->first()->codigo);
//
//            $model->create([
//                'idCliente' => $request->idCliente,
//                'idRuta' => $request->input('idRuta'),
//                'idParadero' => $request->input('idParadero'),
//                'idVehiculo' => $request->input('idVehiculo'),
//                'idCaja' => $request->input('idCaja'),
//                'idPos' => $request->input('idPos'),
//
//                'precio' => $request->input('precio'),
//                'fecha' => $request->input('fecha'),
//                'codigoBoleto' => $request->input('codigoBoleto'),
//                'latitud' => $request->input('latitud'),
//                'longitud' => $request->input('longitud'),
//                'enBlanco' => $request->input('enBlanco'),
//                'idUsuarioRegistro' => $user->getId(),
//
//                // ruc
//
//                'idTipoDocumento' => $request->input('idTipoDocumento'),
//                'numeroDocumento' => $request->input('numeroDocumento'),
//                'nombre' => $request->input('nombre'),
//                'direccion' => $request->input('direccion'),
//
//                // pasajero
//
//
//                'nombres' => $nombres,
//                'apellidos' => $apellidos,
//
//
//                'idTipoComprobante' => $idTipoComprobante,
//                'serieComprobante' => $serieComprobante,
//                'numeroComprobante' => $numeroComprobante,
//
//                'idPorPagar' => $porPagar,
//                'idTipoBoleto' => $idTipoBoleto,
//
//            ]);
//
//            return response()->json([
//                'data' => null,
//                'error' => null,
//                'status' => Response::HTTP_CREATED
//            ],200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
//
//        }catch ( InvalidArgumentException | Exception $e ){
//            return response()->json([
//                'data' => null,
//                'error' => $e->getMessage(),
//                'status' => Response::HTTP_BAD_REQUEST
//            ],200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
//        }
//
//    });


    Route::post('app/boleto-pos-v2', function(Request $request){


        $idBoleto = Uuid::uuid4();
        $idComprobanteElectronico = Uuid::uuid4();

        $idTipoComprobante = $request->has('idTipoComprobante') ? (int)$request->input('idTipoComprobante') : 0;
        $serieComprobante = $request->has('serieComprobante') ? $request->input('serieComprobante') : null;
        $numeroComprobante = $request->has('numeroComprobante') ? (int)$request->input('numeroComprobante') : null;
        $idTipoBoleto = $request->has('idTipoBoleto') ? (int)$request->input('idTipoBoleto') : \App\Enums\IdTipoBoleto::VentaBoleto->value;
        $idRazon = 0;
        $idProductoServicio = 0;

        $porPagar = $request->has('porPagar') ? (int)$request->input('porPagar') : 0;

        switch ($idTipoBoleto){

            case \App\Enums\IdTipoBoleto::Bodega:
                $idRazon = \App\Enums\EnumRazonComprobante::Bodega->value;
                $idProductoServicio = \App\Enums\EnumProductoServicio::Bodega->value;
                break;
            case \App\Enums\IdTipoBoleto::VentaBoleto->value:
            default:
                $idRazon = \App\Enums\EnumRazonComprobante::VentaBoleto->value;
                $idProductoServicio = \App\Enums\EnumProductoServicio::BoletoInterprovincial->value;
                break;
        }



        try {

            if(!\App\Enums\IdTipoBoleto::tryFrom((int)$request->input('idTipoBoleto'))){
                throw new InvalidArgumentException("Valor incorrecto para el tipo de boleto");
            }


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

            $Cliente = \App\Models\V2\Cliente::where('id', $request->input('idCliente'))->where('idEstado',1)->where('idEliminado',0)->get();
            if( $Cliente->isEmpty() ){
                \App\Models\V2\LogBoletoInterprovincial::create([ 'id_cliente' => $request->idCliente,
                    'motivo' => 'Error Cliente',
                    'descripcion' => 'El cliente ' . $request->input('idCliente') . ' no se encuentra registrado en el sistema o esta inhabilitado.',
                ]);
                return response()->json([
                    'data'      => null,
                    'error' => 'El cliente no se encuentra registrado en el sistema o esta inhabilitado.',
                    'status' => 1004
                ],200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
            }
            $_cliente = $Cliente->first();


            $Vehiculo = \App\Models\V2\Vehiculo::where('id', $request->input('idVehiculo'))
                ->where('id_estado',1)
                ->where('id_eliminado',0)
                ->where('id_cliente',$_cliente->id)
                ->get();
            if( $Vehiculo->isEmpty() ){
                \App\Models\V2\LogBoletoInterprovincial::create([ 'id_cliente' => $request->idCliente,
                    'motivo' => 'Error Vehiculo',
                    'descripcion' => 'El vehiculo ' . $request->input('idVehiculo') . ' no se encuentra registrado en el sistema o esta inhabilitado.',
                ]);
                return response()->json([
                    'data'      => null,
                    'error' => 'El vehiculo no se encuentra registrado en el sistema o esta inhabilitado.',
                    'status' => 1005
                ],200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
            }
            $_vehiculo = $Vehiculo->first();


            $Ruta = \App\Models\V2\Ruta::where('id', $request->input('idRuta'))
                ->where('id_estado',1)
                ->where('id_eliminado',0)
                ->where('id_cliente',$_cliente->id)
                ->get();
            if( $Ruta->isEmpty() ){
                \App\Models\V2\LogBoletoInterprovincial::create([ 'id_cliente' => $request->idCliente,
                    'motivo' => 'Error Ruta',
                    'descripcion' => 'La ruta ' . $request->input('idRuta') . ' no se encuentra registrada en el sistema o esta inhabilitada.',
                ]);
                return response()->json([
                    'data'      => null,
                    'error' => 'La ruta no se encuentra registrado en el sistema o esta inhabilitado.',
                    'status' => 1006
                ],200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
            }
            $_ruta = $Ruta->first();



            $Paradero = \App\Models\V2\BoletoPrecio::where('id', $request->input('idParadero'))
                ->where('id_estado',1)
                ->where('id_eliminado',0)
                ->where('id_cliente',$_cliente->id)
                ->get();
            if( $Paradero->isEmpty() ){
                \App\Models\V2\LogBoletoInterprovincial::create([ 'id_cliente' => $request->idCliente,
                    'motivo' => 'Error Viaje',
                    'descripcion' => 'El viaje ' . $request->input('idParadero') . ' no se encuentra registrada en el sistema o esta inhabilitada.',
                ]);
                return response()->json([
                    'data'      => null,
                    'error' => 'El viaje no se encuentra registrado en el sistema o esta inhabilitado.',
                    'status' => 1003
                ],200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
            }
            $_paradero = $Paradero->first();


            $Caja  = \App\Models\V2\Caja::where('id', $request->input('idCaja'))
                ->where('id_estado',1)
                ->where('id_eliminado',0)
                ->where('id_cliente',$_cliente->id)
                ->get();
            if( $Caja->isEmpty() ){
                \App\Models\V2\LogBoletoInterprovincial::create([ 'id_cliente' => $request->idCliente,
                    'motivo' => 'Error Caja',
                    'descripcion' => 'El caja ' . $request->input('idCaja') . ' no se encuentra registrada en el sistema o esta inhabilitada.',
                ]);
                return response()->json([
                    'data'      => null,
                    'error' => 'La caja no se encuentra registrado en el sistema o esta inhabilitado.',
                    'status' => 1007
                ],200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
            }
            $_caja = $Caja->first();

            // Validar apertura de caja
            $cajaApertura = \App\Models\V2\CajaDiario::where('id_caja', $_caja->id)->orderBy('f_apertura', 'DESC')->limit(1);
            if($cajaApertura->count() === 0){
                \App\Models\V2\LogBoletoInterprovincial::create([ 'id_cliente' => $request->idCliente,
                    'motivo' => 'Error Apertura Caja',
                    'descripcion' => 'No existe ninguna apertura de caja ' . $_caja->id
                ]);
                return response()->json([
                    'data'      => null,
                    'error' => 'No existe ninguna apertura de caja ' . $_caja->id,
                    'status' => 1020
                ],200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
            }
            if(!is_null($cajaApertura->first()->f_cierre)){
                \App\Models\V2\LogBoletoInterprovincial::create([ 'id_cliente' => $request->idCliente,
                    'motivo' => 'Error Caja',
                    'descripcion' => 'Debe cerrar primero la caja ' . $request->input('idCaja')
                ]);
                return response()->json([
                    'data'      => null,
                    'error' => 'Debe cerrar primero la caja',
                    'status' => 1021
                ],200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
            }


            $Pos  = \App\Models\V2\Pos::where('id', $request->input('idPos'))
                ->where('id_estado',1)
                ->where('id_eliminado',0)
                ->where('id_cliente',$_cliente->id)
                ->get();
            if( $Pos->isEmpty() ){
                \App\Models\V2\LogBoletoInterprovincial::create([ 'id_cliente' => $request->idCliente,
                    'motivo' => 'Error POS',
                    'descripcion' => 'El equipo POS ' . $request->input('idPos') . ' no se encuentra registrado en el sistema o esta inhabilitado.',
                ]);
                return response()->json([
                    'data'      => null,
                    'error' => 'El equipo POS no se encuentra registrado en el sistema o esta inhabilitado.',
                    'status' => 1008
                ],200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
            }
            $_pos = $Pos->first();

            /******* Verificar que el paradero insertado pertenece a la ruta ******************/
            if($_paradero->id_ruta !== $_ruta->id){
                \App\Models\V2\LogBoletoInterprovincial::create([ 'id_cliente' => $request->idCliente,
                    'motivo' => 'Error Viaje',
                    'descripcion' => 'El viaje '. $_paradero->paraderoOrigen->nombre . ' - ' . $_paradero->paraderoDestino->nombre .' no esta registrado en la ruta ' . $_ruta->nombre,
                ]);
                return response()->json([
                    'data'      => null,
                    'error' => 'El viaje '. $_paradero->paraderoOrigen->nombre . ' - ' . $_paradero->paraderoDestino->nombre .' no esta registrado en la ruta ' . $_ruta->nombre,
                    'status' => 1009
                ],200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
            }
            /******* Verificar que que la caja insertada pertenece al equipo POS ******************/
            if($_caja->id_pos !== $_pos->id){
                \App\Models\V2\LogBoletoInterprovincial::create([ 'id_cliente' => $request->idCliente,
                    'motivo' => 'Error Caja',
                    'descripcion' => 'La caja ' . $_caja->nombre . ' no esta asignada al Equipo POS ' . $_pos->nombre,
                ]);
                return response()->json([
                    'data'  => null,
                    'error' => 'La caja ' . $_caja->nombre . ' no esta asignada al Equipo POS ' . $_pos->nombre,
                    'status' => 1010
                ],200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
            }


//            if (!Schema::hasTable('boleto_interprovincial_cliente_' . $_cliente->codigo)) {
//                DB::statement("CREATE TABLE boleto_interprovincial_cliente_' . $_cliente->codigo . ' LIKE boleto_interprovincial");
//
////                Schema::create('boleto_interprovincial_' . $_cliente->codigo, function (Blueprint $table) {
////                    $table->uuid('id')->unique()->primary();
////                    $table->uuid('idRuta')->nullable();
////                    $table->uuid('idParadero')->nullable();
////                    $table->uuid('idVehiculo')->nullable();
////                    $table->uuid('idCaja')->nullable();
////                    $table->uuid('idPos')->nullable();
////                    $table->uuid('idCliente')->nullable();
////                    $table->smallInteger('idTipoDocumento')->nullable();
////                    $table->string('numeroDocumento',20)->nullable();
////                    $table->string('nombre',250)->nullable();
////                    $table->string('direccion',250)->nullable();
////                    $table->string('codigoBoleto',30)->nullable();
////                    $table->decimal('latitud',10,8)->nullable();
////                    $table->decimal('longitud',10,8)->nullable();
////                    $table->decimal('precio',5,2);
////                    $table->dateTime('fecha');
////                    $table->tinyInteger('idEstado')->default(1);
////                    $table->tinyInteger('idEliminado')->default(0);
////                    $table->tinyInteger('anulado')->default(0);
////                    $table->tinyInteger('enBlanco')->default(0);
////                    $table->uuid('idUsuarioRegistro');
////                    $table->uuid('idUsuarioModifico')->nullable();
////                    $table->timestamp('fechaRegistro');
////                    $table->timestamp('fechaModifico')->nullable();
////                });
//            }

            $model = new \App\Models\V2\BoletoInterprovincialOficial();
            $model->setTable('boleto_interprovincial_cliente_' . $_cliente->codigo);



            /******* Validar que el boleto  ******************/
            if($model->where('codigo',$request->input('codigoBoleto'))->count() > 0){
                \App\Models\V2\LogBoletoInterprovincial::create([ 'id_cliente' => $request->idCliente,
                    'motivo' => 'Error Boleto',
                    'descripcion' => 'El código del boleto ya fue registrado: ' . $request->input('codigoBoleto'),
                ]);
                return response()->json([
                    'data' => null,
                    'error' => 'El código del boleto ya fue registrado',
                    'status' => 1001
                ]);
            }
            /******* Validar que el comprobante  ******************/
            if(\App\Models\V2\ComprobanteElectronico::where('serie',$request->input('serie'))->where('numero',$request->input('numero'))->get()->count()){
                \App\Models\V2\LogBoletoInterprovincial::create([ 'id_cliente' => $request->idCliente,
                    'motivo' => 'Error Comprobante',
                    'descripcion' => 'La serie y el número de comprobante ya fueron registrados :' . $request->input('serie') . ' - ' . $request->input('numero'),
                ]);
                return response()->json([
                    'data' => null,
                    'error' => 'La serie y el número de comprobante ya fueron registrados',
                    'status' => 1002
                ],200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
            }

            /******* Validar viaje  ******************/
            $existe  = \App\Models\V2\BoletoPrecio::select('id')
                ->where('id', $request->input('idParadero'))
                ->where('id_cliente', $_cliente->id)
                ->where('id_ruta', $request->input('idRuta'))->count();
            if($existe == 0){
//                throw new InvalidArgumentException('El viaje no se encuentra registrado en el sistema');
                \App\Models\V2\LogBoletoInterprovincial::create([ 'id_cliente' => $request->idCliente,
                    'motivo' => 'Error Viaje',
                    'descripcion' =>  'El viaje no se encuentra registrado en el sistema: ' . $request->input('idParadero'),
                ]);
                return response()->json([
                    'data' => null,
                    'error' => 'El viaje no se encuentra registrado en el sistema',
                    'status' => 1003
                ],200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
            }
            $viaje = \App\Models\V2\BoletoPrecio::select('id', 'id_paradero_origen', 'id_paradero_destino')->where('id_cliente', $_cliente->id)->where('id_ruta', $request->input('idRuta'))->first();



            /************ Validar boleto *****************/
            $boletoValido = \App\Models\V2\BoletoInterprovincialOficial::select('id')
                ->where('codigo', $request->input('codigoBoleto'))
                ->where('id_cliente', $_cliente->id )
                ->count();
            if($boletoValido > 0){
//                return response()->json([
//                    'data' => null,
//                    'error' => null,
//                    'status' => Response::HTTP_CREATED
//                ]);
                \App\Models\V2\LogBoletoInterprovincial::create([ 'id_cliente' => $request->idCliente,
                    'motivo' => 'Error Boleto',
                    'descripcion' =>  'El codigo del boleto ya fue registrado: ' . $request->input('codigoBoleto'),
                ]);

                return response()->json([
                    'data' => null,
                    'error' => 'El codigo del boleto ya fue registrado',
                    'status' => 1001
                ],200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
            }

            /************ Validar comprobante *****************/
            $comprobanteValido = \App\Models\V2\ComprobanteElectronico::select('id')
                ->where('id_tipo_comprobante', $request->input('idTipoComprobante'))
                ->where('serie', $request->input('serieComprobante'))
                ->where('numero', $request->input('numeroComprobante'))
                ->where('id_cliente', $_cliente->id )
                ->count();
            if($comprobanteValido > 0){
//                return response()->json([
//                    'data' => null,
//                    'error' => null,
//                    'status' => Response::HTTP_CREATED
//                ]);

                \App\Models\V2\LogBoletoInterprovincial::create([ 'id_cliente' => $request->idCliente,
                    'motivo' => 'Error Comprobante',
                    'descripcion' =>  'El comprobante ya fue registrado: ' . $request->input('serieComprobante') . '-' . $request->input('numeroComprobante') . ' al cliente: ' . $_cliente->id,
                ]);

                return response()->json([
                    'data' => null,
                    'error' => 'El comprobante ya fue registrado',
                    'status' => 1002
                ],200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
            }

            $model->create([
                'id' => $idBoleto,
                'id_ruta' => $request->input('idRuta'),
                'id_paradero_origen' => $viaje->id_paradero_origen,
                'id_paradero_destino' => $viaje->id_paradero_destino,
                'id_vehiculo' => $request->input('idVehiculo'),
                'id_caja' => $request->input('idCaja'),
                'id_pos' => $request->input('idPos'),
                'id_cliente' => $_cliente->id,

                // boleto
                'codigo' => $request->input('codigoBoleto'),
                'latitud' => $request->input('latitud'),
                'longitud' => $request->input('longitud'),
                'precio' => $request->input('precio'),
                'f_partida' => (new DateTime($request->input('fecha')))->format('Y-m-d'),
                'h_partida' => (new DateTime($request->input('hora')))->format('H:m:s'),
                'id_usu_registro' => $user->getId(),
                'id_sede' => $_caja->id_sede,

                //pasajero
                'id_tipo_documento' => $request->input('idTipoDocumento'),
                'numero_documento' => $request->input('numeroDocumento'),
                'nombres' => $request->input('nombres'),
                'apellidos' => $request->input('apellidos'),
                'nombre' => $request->input('nombres') . ' ' . $request->input('apellidos'),

                // estados
//                'enBlanco' => 0,
                'anulado' => 0,

//                // comprobante
                'id_tipo_comprobante' => $idTipoComprobante,
                'serieComprobante' => $serieComprobante,
                'numeroComprobante' => $numeroComprobante,

                'por_pagar' => $porPagar,
                'id_tipo_boleto' => $idTipoBoleto,

                'menor_edad' => (boolean)$request->input('menorEdad'),

                'id_tipo_moneda' => \App\Enums\EnumTipoMoneda::Soles->value,
                'id_forma_pago' => \App\Enums\EnumFormaPago::Contado->value,
                'obsequio' => false,
                'f_emision' => (new DateTime('now'))->format('Y-m-d H:m:s'),
                'id_estado' => 1,
                'id_origen' => \App\Enums\EnumOrigenBoleto::POS->value,
            ]);




            $idTipoDocumentoEntidad = '';
            switch ($idTipoComprobante){
                case \App\Enums\EnumTipoComprobante::Factura:
                    $idTipoDocumentoEntidad = $request->input('idTipoDocumentoCliente');
                    break;
                default:
                    $idTipoDocumentoEntidad = $request->input('idTipoDocumento');
                    break;
            }
            $numeroDocumentoEntidad = '';
            switch ($idTipoComprobante){
                case \App\Enums\EnumTipoComprobante::Factura:
                    $numeroDocumentoEntidad = $request->input('numeroDocumentoCliente');
                    break;
                default:
                    $numeroDocumentoEntidad = $request->input('numeroDocumento');
                    break;
            }
            $nombreEntidad = '';
            switch ($idTipoComprobante){
                case \App\Enums\EnumTipoComprobante::Factura:
                    $nombreEntidad = $request->input('nombreCliente');
                    break;
                default:
                    $nombreEntidad = $request->input('nombres') . ' ' . $request->input('apellidos');
                    break;
            }

            \App\Models\V2\ComprobanteElectronico::create([
                'id' => $idComprobanteElectronico,
                'id_cliente' => $_cliente->id,
                'id_sede' => $_caja->id_sede,

                'id_tipo_comprobante' => $idTipoComprobante,
                'serie' => $serieComprobante,
                'numero' => $numeroComprobante,
                'id_sunat_transaccion' => \App\Enums\EnumSunatTransaccion::VentaInterna->value,

                'id_tipo_documento_entidad' => $idTipoDocumentoEntidad,
                'numero_documento_entidad' => $numeroDocumentoEntidad,
                'nombre_entidad' => $nombreEntidad,
                'direccion' => $request->input('direccionCliente'),
                'email' => null,
                'email1' => null,
                'email2' => null,

                'f_emision' => (new DateTime('now'))->format('Y-m-d H:m:s'),
                'f_vencimiento' => (new DateTime('now'))->format('Y-m-d H:m:s'),

                'id_moneda' => \App\Enums\EnumTipoMoneda::Soles,
                'tipo_cambio' => null,
                'porcentaje_igv' => 0,
                'descuento_global' => 0,
                'to_descuento' => 0,
                'to_anticipo' => 0,
                'to_gravada' => $request->input('precio'),
                'to_inafecta' => 0,
                'to_exonerada' => $request->input('precio'),
                'to_igv' => 0,
                'to_gratuita' => 0,
                'to_otros' => 0,
                'to_isc' => 0,
                'total' => $request->input('precio'),

                'id_percepcion_tipo' => null,
                'percepcion_base_imponible' => 0,
                'to_percepcion' => 0,
                'to_incluido_percepcion' => 0,

                'id_retencion_tipo' => null,
                'retencion_base_imponible' => 0,
                'to_retencion' => 0,

                'to_imp_bolsa' => 0,
                'observaciones' => null,

                'id_tipo_comprobante_modif' => null,
                'serie_comprobante_modif' => null,
                'numero_comprobante_modif' => null,

                'id_tipo_nota_credito' => null,
                'id_tipo_nota_debito' => null,

                'bl_enviar_sunat' => false,
                'bl_enviar_cliente' => false,

                'condiciones_pago' => null,
                'medio_pago' => null,

                'placa_vehiculo' => null,
                'order_compra_servicio' => null,

                'bl_detraccion' => false,
                'id_detraccion' => null,

                'formato_de_pdf' => 'TICKET',

                'contingencia' => false,
                'bienes_region_selva' => false,
                'serv_region_selva' => false,

                'id_razon' => $idTipoBoleto === \App\Enums\IdTipoBoleto::VentaBoleto ? \App\Enums\EnumCeRazon::VentaBoletoInterprovincial->value : \App\Enums\EnumCeRazon::Encomienda->value,
                'id_producto' => $idBoleto,

                'id_estado' => 1,
                'id_usu_registro' => $user->getId(),
//                'id_usu_modifico' => $user->getId(),
            ]);

                \App\Models\V2\ComprobanteElectronicoItem::create([
                    'id_comprobante' => $idComprobanteElectronico,
                    'id_cliente' => $request->input('idCliente'),

                    'id_unidad_medida' => \App\Enums\EnumUnidadMedida::Servicio->value,
                    'codigo' => $idBoleto,
                    'descripcion' => 'BOLETO INTERPROVINCIAL | RUTA:' . $_ruta->nombre . ' | DESTINO:' . $_paradero->nombre,
                    'cantidad' => 1,
                    'valor_unitario' => $request->input('precio'),
                    'precio_unitario' => $request->input('precio'),
                    'descuento' => 0,
                    'sub_total' => $request->input('precio'),
                    'id_tipo_igv' => \App\Enums\EnumSunatTipoIgv::ExoneradoTransferenciaGratuita->value,
                    'id_tipo_ivap' => null,
                    'igv' => 0,
                    'impBolsa' => 0,
                    'total' => $request->input('precio'),

                    'anticipo_regularizar' => false,
                    'anticipo_comprobante_serie' => null,
                    'anticipo_comprobante_numero' => null,

                    'codigo_producto_sunat' => null,
                    'tipo_isc' => 0,
                    'isc' => 0,


                    'id_usu_registro' => $user->getId(),
//                    'id_usu_modifico' => $user->getId(),
                ]);


//            $model->findOrFail($idBoleto)->update([
//               'id_comprobante' => $idComprobanteElectronico
//            ]);


            return response()->json([
                'data' => null,
                'error' => null,
                'status' => Response::HTTP_CREATED
            ],200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);

        }catch ( InvalidArgumentException | Exception $e ){
            return response()->json([
                'data' => null,
                'error' => $e->getMessage(),
                'status' => Response::HTTP_BAD_REQUEST
            ],200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
        }

    });
});
