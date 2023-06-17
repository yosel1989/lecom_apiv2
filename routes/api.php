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
                $table->string('bussiness_name',50);
                $table->string('first_name',50);
                $table->string('last_name',50);
                $table->string('ruc',15);
                $table->string('dni',8);
                $table->string('email',50);
                $table->string('address',100);
                $table->string('phone',15);
                $table->integer('type');
                $table->integer('deleted')->default(0);
                $table->uuid('id_parent_client')->nullable();
            });
        }

        $code = 'aA1bB2cC3dD4eE5fF6gG7hH8iI9jJ0kK1lL2mM3nN4oO5pP6qQ7rR8sS9tT0uU1vV2wW3xX4yY5zZ6';
        $
        echo strlen($code);

        echo substr($code,100,1);

    });
});

Route::post('app/login', [App\Http\Controllers\Api\Apps\BoleteroPOS\AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function() {
    Route::post('logout', [App\Http\Controllers\AuthController::class, 'logout']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
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
