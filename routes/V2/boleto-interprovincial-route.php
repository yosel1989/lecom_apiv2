<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;


Route::namespace('App\Http\Controllers\Api\V2\BoletoInterprovincial')->middleware('auth:sanctum')->group( function (){
    Route::get('cliente/{id}/boleto-interprovincial', 'GetCollectionByClienteController');
    Route::post('boleto-interprovincial/{id}/cambiar-estado', 'ChangeStateController');
    Route::get('boleto-interprovincial/{id}', 'FindByIdController');


    Route::get('cliente/{id}/{fechaDesde}/{fechaHasta}/boleto-interprovincial/reporte', 'GetReportByClienteController');
});




Route::middleware('auth:sanctum')->group(function() {
    Route::post('app/{idCliente}/boleto-pos', function(Request $request){

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
            $_ruta = $Vehiculo->first();



            $Paradero = \App\Models\V2\Paradero::where('id', $request->input('idParadero'))
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
            $_ruta = $Vehiculo->first();



            if( $Vehiculo->isEmpty() ){
                return response()->json([
                    'data'      => null,
                    'error' => 'El vehiculo no se encuentra registrado en el sistema.',
                    'status' => \Symfony\Component\HttpFoundation\Response::HTTP_NOT_FOUND
                ]);
            }

            if( $Destino->isEmpty() ){
                return response()->json([
                    'data'      => null,
                    'error' => 'El destino no se encuentra registrado en el sistema.',
                    'status' => \Symfony\Component\HttpFoundation\Response::HTTP_NOT_FOUND
                ]);
            }

            if( $Cliente->isEmpty() ){
                return response()->json([
                    'data'      => null,
                    'error' => 'El cliente no se encuentra registrado en el sistema.',
                    'status' => \Symfony\Component\HttpFoundation\Response::HTTP_NOT_FOUND
                ]);
            }


            if (!Schema::hasTable('boleto_interprovincial_' . $Cliente->first()->codigo)) {
                Schema::create('boleto_interprovincial_' . $Cliente->first()->codigo, function (Blueprint $table) {
                    $table->uuid('id')->unique()->primary();
                    $table->uuid('idDestino')->nullable();
                    $table->uuid('idVehiculo')->nullable();
                    $table->uuid('idCliente')->nullable();
                    $table->string('numeroDocumento',20)->nullable();
                    $table->string('codigoBoleto',30)->nullable();
                    $table->decimal('latitud',10,8)->nullable();
                    $table->decimal('longitud',10,8)->nullable();
                    $table->decimal('precio',5,2);
                    $table->dateTime('fecha');
                    $table->tinyInteger('idEstado')->default(1);
                    $table->tinyInteger('idEliminado')->default(0);
                    $table->uuid('idUsuarioRegistro');
                    $table->uuid('idUsuarioModifico')->nullable();
                    $table->timestamp('fechaRegistro');
                    $table->timestamp('fechaModifico')->nullable();
                });
            }

            $model = new \App\Models\V2\BoletoInterprovincial();
            $model->setTable('boleto_interprovincial_' . $Cliente->first()->codigo);

            $model->create([
                'idCliente' => $request->input('idCliente'),
                'idVehiculo' => $request->input('idVehiculo'),
                'idDestino' => $request->input('idDestino'),
                'numeroDocumento' => $request->input('numeroDocumento'),
                'precio' => $request->input('precio'),
                'fecha' => $request->input('fecha'),
                'codigoBoleto' => $request->input('codigoBoleto'),
                'latitud' => $request->input('latitud'),
                'longitud' => $request->input('longitud'),
                'idUsuarioRegistro' => $user->getId()
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
