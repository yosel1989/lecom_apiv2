<?php

//use App\Events\AlertColdMachineHistoryEvent;
use App\Http\Controllers\Older\RegisterErtStateController;
use App\Models\V2\Destino;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

Route::post('register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function() {
    Route::post('app/boleto-pos', function(Request $request){

        try {
            $user = Auth::user();
//
//            $Vehiculo = \App\Models\Administracion\Vehiculo::where('id', $request->input('idVehiculo'))->where('idEstado',1)->get();
//            $Destino = Destino::where('id', $request->input('idDestino'))->where('idEstado',1)->get();
//            $Cliente = \App\Models\Admin\Client::where('id', $request->input('idCliente'))->where('deleted',0)->get();
//
//            if( $Vehiculo->isEmpty() ){
//                return response()->json([
//                    'data'      => null,
//                    'error' => 'El vehiculo no se encuentra registrado en el sistema.',
//                    'status' => \Symfony\Component\HttpFoundation\Response::HTTP_NOT_FOUND
//                ]);
//            }
//
//            if( $Destino->isEmpty() ){
//                return response()->json([
//                    'data'      => null,
//                    'error' => 'El destino no se encuentra registrado en el sistema.',
//                    'status' => \Symfony\Component\HttpFoundation\Response::HTTP_NOT_FOUND
//                ]);
//            }
//
//            if( $Cliente->isEmpty() ){
//                return response()->json([
//                    'data'      => null,
//                    'error' => 'El cliente no se encuentra registrado en el sistema.',
//                    'status' => \Symfony\Component\HttpFoundation\Response::HTTP_NOT_FOUND
//                ]);
//            }


//            if (!Schema::hasTable('boleto_interprovincial_' . $Cliente->first()->codigo)) {
//                Schema::create('boleto_interprovincial_' . $Cliente->first()->codigo, function (Blueprint $table) {
//                    $table->uuid('id')->unique()->primary();
//                    $table->uuid('idDestino')->nullable();
//                    $table->uuid('idVehiculo')->nullable();
//                    $table->uuid('idCliente')->nullable();
//                    $table->string('numeroDocumento',20)->nullable();
//                    $table->string('codigoBoleto',30)->nullable();
//                    $table->decimal('latitud',10,8)->nullable();
//                    $table->decimal('longitud',10,8)->nullable();
//                    $table->decimal('precio',5,2);
//                    $table->dateTime('fecha');
//                    $table->tinyInteger('idEstado')->default(1);
//                    $table->tinyInteger('idEliminado')->default(0);
//                    $table->uuid('idUsuarioRegistro');
//                    $table->uuid('idUsuarioModifico')->nullable();
//                    $table->timestamp('fechaRegistro');
//                    $table->timestamp('fechaModifico')->nullable();
//                });
//            }
//
//            $model = new \App\Models\V2\BoletoInterprovincial();
//            $model->setTable('boleto_interprovincial_' . $Cliente->first()->codigo);
//
//            $model->create([
//                'idCliente' => $request->input('idCliente'),
//                'idVehiculo' => $request->input('idVehiculo'),
//                'idDestino' => $request->input('idDestino'),
//                'numeroDocumento' => $request->input('numeroDocumento'),
//                'precio' => $request->input('precio'),
//                'fecha' => $request->input('fecha'),
//                'codigoBoleto' => $request->input('codigoBoleto'),
//                'latitud' => $request->input('latitud'),
//                'longitud' => $request->input('longitud'),
//                'idUsuarioRegistro' => $user->getId()
//            ]);

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

Route::post('app/login', [App\Http\Controllers\Api\Apps\BoleteroPOS\AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function() {
    Route::post('logout', [App\Http\Controllers\AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('clear',function(){

    Artisan::call('package:discover --ansi');
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');

    return 'clear exit';
});

Route::get('wsk/start',function(){

    Artisan::call('websockets:serve');

    return 'socket start';
});
Route::get('wsk/restart',function(){

    Artisan::call('websockets:restart');

    return 'socket restart';
});

Route::get('time',function(){

    $date = new \DateTime();
    $date->setTimestamp(1633878600);
    return $date->format('Y-m-d H:i:s');
});


//
include 'Modules/coldMachine.php';
include 'Modules/vehicleTicketing.php';
include 'Modules/dashboard.php';
include 'Modules/auth.php';
include 'Modules/despacho.php';
include 'Modules/general.php';
include 'Modules/administracion.php';
include 'Modules/coldMachine.php';
include 'Modules/transportePersonal.php';
include 'Modules/transporteInterprovincial.php';


include 'V2/auth-route.php';
include 'V2/vehiculo-route.php';
include 'V2/personal-route.php';
include 'V2/usuario-route.php';
include 'V2/perfil-route.php';
include 'V2/sede-route.php';
include 'V2/caja-route.php';
include 'V2/modulo-route.php';
include 'V2/pos-route.php';
include 'V2/destino-route.php';
include 'V2/boleto-interprovincial-route.php';


Route::get('v1/erts', function(){
    $all = \App\Models\Older\ErtUbicacion::all();
    return response()->json($all);
});

Route::prefix('App')->namespace('/Older')->group( function () {
    Route::post('v1/ert_state', [RegisterErtStateController::class]);
});

Route::get('websocket', function(){
    broadcast(new AlertColdMachineHistoryEvent("ded"));
});
