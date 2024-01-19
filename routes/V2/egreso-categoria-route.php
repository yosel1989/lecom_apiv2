<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\EgresoCategoria')->middleware('auth:sanctum')->group( function (){
    Route::get('cliente/{id}/egreso-categoria', 'GetCollectionByClienteController');
    Route::get('cliente/{id}/egreso-categoria/listado', 'GetListByClienteController');
    Route::post('cliente/egreso-categoria', 'CreateController');
    Route::post('egreso-categoria/{id}/cambiar-estado', 'ChangeStateController');
    Route::get('egreso-categoria/{id}', 'FindByIdController');
    Route::put('egreso-categoria/{id}', 'UpdateController');
});
