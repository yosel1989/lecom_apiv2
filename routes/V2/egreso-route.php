<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\Egreso')->middleware('auth:sanctum')->group( function (){
    Route::post('cliente/egreso', 'CreateController');
    Route::get('cliente/{id}/egreso/reporte-despacho/usuario', 'GetReporteDespachoByClienteController');
});
