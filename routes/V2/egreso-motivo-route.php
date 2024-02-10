<?php
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\Api\V2\EgresoMotivo')->middleware('auth:sanctum')->group( function (){
    Route::get('egreso-motivo/estado/{idEstado}', 'GetCollectionByEstadoController');
});
