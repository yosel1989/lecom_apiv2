<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\Sede')->middleware('auth:sanctum')->group( function (){
    Route::get('cliente/{id}/sede', 'GetCollectionByClienteController');
    Route::get('cliente/{id}/sede/listado', 'GetListByClienteController');
    Route::post('cliente/{id}/sede', 'CreateController');
    Route::post('sede/{id}/cambiar-estado', 'ChangeStateController');
    Route::get('sede/{id}', 'FindByIdController');
    Route::put('sede/{id}', 'UpdateController');
});
