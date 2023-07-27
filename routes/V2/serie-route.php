<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\Serie')->middleware('auth:sanctum')->group( function (){
    Route::get('cliente/{id}/serie', 'GetCollectionByClienteController');
    Route::get('cliente/{id}/serie/listado', 'GetListByClienteController');
    Route::post('cliente/{id}/serie', 'CreateController');
    Route::post('serie/{id}/cambiar-estado', 'ChangeStateController');
    Route::get('serie/{id}', 'FindByIdController');
    Route::put('serie/{id}', 'UpdateController');
});
