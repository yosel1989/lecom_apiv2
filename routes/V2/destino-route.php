<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\Destino')->middleware('auth:sanctum')->group( function (){
    Route::get('cliente/{id}/destino', 'GetCollectionByClienteController');
    Route::get('cliente/{id}/destino/listado', 'GetListByClienteController');
    Route::post('cliente/{id}/destino', 'CreateController');
    Route::post('destino/{id}/cambiar-estado', 'ChangeStateController');
    Route::get('destino/{id}', 'FindByIdController');
    Route::put('destino/{id}', 'UpdateController');
});

