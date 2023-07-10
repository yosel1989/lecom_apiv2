<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\Pos')->middleware('auth:sanctum')->group( function (){
    Route::get('cliente/{id}/pos', 'GetCollectionByClienteController');
    Route::get('cliente/{id}/pos/listado', 'GetListByClienteController');
    Route::post('cliente/{id}/pos', 'CreateController');
    Route::post('pos/{id}/cambiar-estado', 'ChangeStateController');
    Route::get('pos/{id}', 'FindByIdController');
    Route::put('pos/{id}', 'UpdateController');
});
