<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\EgresoTipo')->middleware('auth:sanctum')->group( function (){
    Route::get('cliente/{id}/egreso-tipo', 'GetCollectionByClienteController');
    Route::get('cliente/{id}/egreso-tipo/listado', 'GetListByClienteController');
    Route::get('cliente/{id}/egreso-tipo/categoria/{idCategoria}', 'GetListByClienteByCategoriaController');
    Route::post('cliente/egreso-tipo', 'CreateController');
    Route::post('egreso-tipo/{id}/cambiar-estado', 'ChangeStateController');
    Route::get('egreso-tipo/{id}', 'FindByIdController');
    Route::put('egreso-tipo/{id}', 'UpdateController');
});
