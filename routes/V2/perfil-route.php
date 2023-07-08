<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\Perfil')->middleware('auth:sanctum')->group( function (){
    Route::get('cliente/{id}/perfil', 'GetCollectionByClienteController');
    Route::get('cliente/{id}/perfil/listado', 'GetListByClienteController');
    Route::get('cliente/{id}/{idNivelUsuario}/perfil', 'GetCollectionByClienteByNivelController');
    Route::get('cliente/{id}/{idNivelUsuario}/perfil/listado', 'GetListByClienteByNivelController');
    Route::post('cliente/{id}/perfil', 'CreateController');
    Route::post('perfil/{id}/cambiar-estado', 'ChangeStateController');
    Route::get('perfil/{id}', 'FindByIdController');
    Route::put('perfil/{id}', 'UpdateController');
});
