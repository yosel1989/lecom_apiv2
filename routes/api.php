<?php

use App\Events\AlertColdMachineHistoryEvent;
use App\Http\Controllers\Exports\Pdf\liquidacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');


Route::middleware('auth:api')->group(function() {
    Route::post('logout', 'AuthController@logout');
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



include 'Modules/coldMachine.php';
include 'Modules/vehicleTicketing.php';
include 'Modules/dashboard.php';
include 'Modules/auth.php';
include 'Modules/despacho.php';
include 'Modules/general.php';
include 'Modules/administracion.php';
//include 'Modules/coldMachine.php';
include 'Modules/transportePersonal.php';


Route::get('v1/erts', function(){
    $all = \App\Models\Older\ErtUbicacion::all();
    return response()->json($all);
});

Route::namespace('Older')->group( function () {
    Route::post('v1/ert_state', 'RegisterErtStateController');
});

Route::get('websocket', function(){
    broadcast(new AlertColdMachineHistoryEvent('ded'));
});
