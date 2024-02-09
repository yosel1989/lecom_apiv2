<?php
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\Api\V2\LiquidacionMotivo')->middleware('auth:sanctum')->group( function (){
    Route::get('liquidacion-motivo/estado/{idEstado}', 'GetCollectionByEstadoController');
});
