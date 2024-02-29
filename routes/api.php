<?php

use App\Http\Controllers\Older\RegisterErtStateController;
use App\Models\V2\Sede;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

Route::post('register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);




Route::post('app/login', [App\Http\Controllers\Api\Apps\BoleteroPOS\AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function() {
    Route::post('logout', [App\Http\Controllers\AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/check', function (Request $request) {
    $user = $request->user();
    return response()->json([
        'data'=>[
            'usuario' => [
                'id' => $user->id,
                'usuario' => $user->usuario,
                'nombres' => $user->nombres,
                'apellidos' => $user->apellidos,
                'correo' => $user->correo,
                'idNivel' => $user->id_nivel,
                'idPerfil' => $user->id_perfil,
                'perfil' => $user->id_perfil ? $user->perfil->nombre : null,
                'idEstado' => $user->id_estado,
                'idCliente' => $user->id_cliente,
                'cliente' => $user->id_cliente ? $user->cliente->nombre : null,
                'idSede' => $user->personal ? $user->personal->id_sede : null,
                'sede' => $user->personal ? Sede::findOrFail($user->personal->id_sede)->nombre : null,
            ],
        ],
        'error' => null,
        'status' => Response::HTTP_OK
    ]);
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
//include 'Modules/coldMachine.php';
//include 'Modules/vehicleTicketing.php';
//include 'Modules/dashboard.php';
//include 'Modules/auth.php';
//include 'Modules/despacho.php';
//include 'Modules/general.php';
//include 'Modules/administracion.php';
//include 'Modules/coldMachine.php';
//include 'Modules/transportePersonal.php';
//include 'Modules/transporteInterprovincial.php';


include 'V2/auth-route.php';
include 'V2/vehiculo-route.php';
include 'V2/personal-route.php';
include 'V2/cliente-route.php';
include 'V2/usuario-route.php';
include 'V2/perfil-route.php';
include 'V2/sede-route.php';
include 'V2/caja-route.php';
include 'V2/modulo-route.php';
include 'V2/modulo-menu-route.php';
include 'V2/pos-route.php';
include 'V2/destino-route.php';
include 'V2/boleto-interprovincial-route.php';
include 'V2/sunat-route.php';
include 'V2/ruta-route.php';
include 'V2/tipo-documento-route.php';
include 'V2/tipo-serie-route.php';
include 'V2/tipo-ruta-route.php';
include 'V2/paradero-route.php';
include 'V2/comprobante-serie-route.php';
include 'V2/caja-diario-route.php';
include 'V2/tipo-comprobante-route.php';
include 'V2/tipo-pago-route.php';
include 'V2/tipo-moneda-route.php';
include 'V2/boleto-precio-route.php';
include 'V2/log-boleto-interprovincial-route.php';
include 'V2/perfil-modulo-route.php';
include 'V2/perfil-modulo-menu-route.php';
include 'V2/motivo-traslado-route.php';
include 'V2/origen-boleto-route.php';
include 'V2/egreso-categoria-route.php';
include 'V2/egreso-tipo-route.php';
include 'V2/egreso-route.php';
include 'V2/egreso-detalle-route.php';
include 'V2/cliente-modulo-route.php';
include 'V2/cliente-modulo-menu-route.php';
include 'V2/export-route.php';
include 'V2/tipo-personal-route.php';
include 'V2/liquidacion-route.php';
include 'V2/liquidacion-motivo-route.php';
include 'V2/egreso-motivo-route.php';
include 'V2/ingreso-categoria-route.php';
include 'V2/ingreso-tipo-route.php';
include 'V2/ingreso-route.php';
include 'V2/medio-pago-route.php';
include 'V2/entidad-financiera-route.php';




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
