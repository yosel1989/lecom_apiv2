<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\Cliente')->middleware('auth:sanctum')->group( function (){
    Route::get('cliente/{id}/cliente', 'GetCollectionByClienteController');
    Route::get('cliente/{id}/cliente/listado', 'GetListByClienteController');
    Route::post('cliente', 'CreateController');
    Route::post('cliente/{id}/cambiar-estado', 'ChangeStateController');
    Route::get('cliente/{id}', 'FindByIdController');
    Route::put('cliente/{id}', 'UpdateController');
});
