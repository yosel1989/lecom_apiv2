<?php
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\Api\V2\Caja')->middleware('auth:sanctum')->group( function (){
    Route::get('cliente/{id}/caja', 'GetCollectionByClienteController');
    Route::get('cliente/{id}/caja/listado', 'GetListByClienteController');
    Route::get('cliente/{id}/{idSede}/caja/despacho/listado', 'GetListBySedeDespachoController');
    Route::get('cliente/{id}/{idSede}/caja/listado', 'GetListBySedeController');
    Route::post('cliente/{id}/caja', 'CreateController');
    Route::post('caja/{id}/cambiar-estado', 'ChangeStateController');
    Route::get('caja/{id}', 'FindByIdController');
    Route::put('caja/{id}', 'UpdateController');
    Route::get('caja/{id}/caja-diario/{idCajaDiario}', 'FindByIdToDespachoController');
});
