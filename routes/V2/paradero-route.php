<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\Paradero')->middleware('auth:sanctum')->group( function (){
    Route::get('cliente/{id}/paradero', 'GetCollectionByClienteController');
    Route::get('cliente/{id}/paradero/listado', 'GetListByClienteController');
    Route::post('cliente/{id}/paradero', 'CreateController');
    Route::post('paradero/{id}/cambiar-estado', 'ChangeStateController');
    Route::get('paradero/{id}', 'FindByIdController');
    Route::put('paradero/{id}', 'UpdateController');
});

