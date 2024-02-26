<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\IngresoTipo')->middleware('auth:sanctum')->group( function (){
    Route::get('cliente/{id}/ingreso-tipo', 'GetCollectionByClienteController');
    Route::get('cliente/{id}/ingreso-tipo/listado', 'GetListByClienteController');
    Route::get('cliente/{id}/ingreso-tipo/categoria/{idCategoria}', 'GetListByClienteByCategoriaController');
    Route::post('cliente/ingreso-tipo', 'CreateController');
    Route::post('ingreso-tipo/{id}/cambiar-estado', 'ChangeStateController');
    Route::get('ingreso-tipo/{id}', 'FindByIdController');
    Route::put('ingreso-tipo/{id}', 'UpdateController');
});
