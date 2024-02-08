<?php
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\Api\V2\Liquidacion')->middleware('auth:sanctum')->group( function (){
    Route::post('liquidacion', 'CreateController');
    Route::post('liquidacion/anular', 'AnularLiquidacionController');
    Route::get('liquidacion/{idCliente}/{fechaDesde}/{fechaHasta}', 'GetCollectionByClienteController');
});
