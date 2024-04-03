<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\MedioPago')->middleware('auth:sanctum')->group( function (){
    Route::get('medio-pago/despacho/listado', 'GetCollectionToDespachoController');
    Route::get('medio-pago/caja-diario/{idCliente}/{idCajaDiario}/listado', 'GetCollectionToCajaDiarioController');
    Route::get('medio-pago/caja-diario/flujo/{idCliente}/{idCajaDiario}/listado', 'GetFlujoToCajaDiarioController');
});
