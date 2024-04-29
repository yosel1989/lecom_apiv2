<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\Empresa')->middleware('auth:sanctum')->group( function (){
    Route::get('cliente/{id}/empresa', 'GetCollectionByClienteController');
    Route::get('cliente/{id}/empresa/listado', 'GetListByClienteController');
    Route::post('cliente/{id}/empresa', 'CreateController');
    Route::post('empresa/{id}/cambiar-estado', 'ChangeStateController');
    Route::get('empresa/{id}', 'FindByIdController');
    Route::put('empresa/{id}', 'UpdateController');

    Route::put('cliente/{idCliente}/empresa/{id}/cambiar-predeterminado', 'ChangePredeterminadoController');

});
