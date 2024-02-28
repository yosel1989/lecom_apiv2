<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\EgresoDetalle')->middleware('auth:sanctum')->group( function (){
    Route::get('cliente/{id}/{idEgreso}/egreso-detalle', 'GetCollectionByClienteController');
    Route::post('cliente/{id}/egreso-detalle/reporte', 'GetReporteByClienteController');
});
