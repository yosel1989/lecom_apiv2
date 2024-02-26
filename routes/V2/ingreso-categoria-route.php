<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\IngresoCategoria')->middleware('auth:sanctum')->group( function (){
    Route::get('cliente/{id}/ingreso-categoria', 'GetCollectionByClienteController');
    Route::get('cliente/{id}/ingreso-categoria/listado', 'GetListByClienteController');
    Route::post('cliente/ingreso-categoria', 'CreateController');
    Route::post('ingreso-categoria/{id}/cambiar-estado', 'ChangeStateController');
    Route::get('ingreso-categoria/{id}', 'FindByIdController');
    Route::put('ingreso-categoria/{id}', 'UpdateController');
});
