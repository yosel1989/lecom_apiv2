<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\Ruta')->middleware('auth:sanctum')->group( function (){
    Route::get('cliente/{id}/ruta', 'GetCollectionByClienteController');
    Route::get('cliente/{id}/ruta/listado', 'GetListByClienteController');
    Route::post('cliente/{id}/ruta', 'CreateController');
    Route::post('ruta/{id}/cambiar-estado', 'ChangeStateController');
    Route::get('ruta/{id}', 'FindByIdController');
    Route::put('ruta/{id}', 'UpdateController');
});
