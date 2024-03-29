<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\Vehiculo')->middleware('auth:sanctum')->group( function (){
    Route::get('cliente/{id}/vehiculos', 'GetCollectionByClienteController');
    Route::get('usuario/{id}/vehiculos', 'GetCollectionByUsuarioController');
    Route::get('usuario-actual/vehiculos', 'GetListByUsuarioActualController');
    Route::get('cliente/{id}/vehiculos/lista', 'GetListByClienteController');
    Route::post('cliente/{idCliente}/vehiculo', 'CreateController');
    Route::post('vehiculo/{idVehiculo}/cambiar-estado', 'ChangeStateController');
    Route::put('vehiculo/{id}', 'UpdateController');
    Route::get('vehiculo/{id}', 'FindByIdController');
    Route::get('vehiculo-qr/{id}', 'FindQrByIdController');

    Route::post('usuario/{id}/asignar-vehiculos', 'AsignarUsuarioController');
});

Route::namespace('App\Http\Controllers\Api\V2\Vehiculo')->group( function (){
    Route::get('vehiculo/{id}', 'FindByIdController');
});
