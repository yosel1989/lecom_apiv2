<?php

//use App\Events\AlertColdMachineHistoryEvent;
use App\Http\Controllers\Older\RegisterErtStateController;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

Route::post('register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function() {
    Route::get('app/database', function(){
        $user = Auth::user();

        if (!Schema::hasTable('btj_boletos_' . $user->idCliente)) {
            Schema::create('btj_boletos_' . $user->idCliente, function (Blueprint $table) {
                $table->uuid('id')->unique()->primary();
                $table->uuid('idDestino')->nullable();
                $table->uuid('idVehiculo')->nullable();
                $table->uuid('idCliente')->nullable();
                $table->uuid('numeroDocumento')->nullable();
                $table->string('serie')->nullable();
                $table->int('numeroBoleto')->nullable();
                $table->decimal('latitud',10,8)->nullable();
                $table->decimal('longitud',10,8)->nullable();
                $table->decimal('precio',5,2);
                $table->dateTime('fechaRegistro');
            });
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
