<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\Usuario')->middleware('auth:sanctum')->group( function (){
    Route::get('cliente/{id}/usuario', 'GetCollectionByClienteController');
    Route::post('cliente/{idCliente}/usuario', 'CreateController');
    Route::post('usuario/{id}/cambiar-estado', 'ChangeStateController');
    Route::post('usuario/{id}/cambiar-clave', 'ChangePasswordController');
    Route::get('usuario/{id}', 'FindByIdController');
    Route::put('usuario/{id}', 'UpdateController');
});
