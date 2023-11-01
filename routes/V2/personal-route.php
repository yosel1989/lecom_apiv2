<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\Personal')->middleware('auth:sanctum')->group( function (){
    Route::get('cliente/{id}/personal', 'GetCollectionByClienteController');
    Route::get('cliente/{id}/personal/listado', 'GetListByClienteController');
    Route::post('cliente/{idCliente}/personal', 'CreateController');
    Route::post('personal/{id}/cambiar-estado', 'ChangeStateController');
    Route::get('personal/{id}', 'FindByIdController');
    Route::post('personal/{id}', 'UpdateController');
});
