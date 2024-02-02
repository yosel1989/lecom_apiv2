<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\TipoPersonal')->middleware('auth:sanctum')->group( function (){
    Route::get('cliente/{id}/tipo-personal', 'GetCollectionByClienteController');
    Route::get('cliente/{id}/tipo-personal/listado', 'GetListByClienteController');
    Route::post('cliente/{id}/tipo-personal', 'CreateController');
    Route::post('tipo-personal/{id}/cambiar-estado', 'ChangeStateController');
    Route::get('tipo-personal/{id}', 'FindByIdController');
    Route::put('tipo-personal/{id}', 'UpdateController');
});
