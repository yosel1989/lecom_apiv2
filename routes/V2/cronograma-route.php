<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\Cronograma')->middleware('auth:sanctum')->group( function (){
    Route::post('cronograma', 'CreateController');
    Route::get('cronograma/{id}', 'FindByIdController');
//    Route::get('cliente/{id}/egreso/reporte-despacho/usuario', 'GetReporteDespachoByClienteController');
//    Route::post('cliente/{id}/egreso/reporte', 'GetReporteByClienteController');
//    Route::put('egreso/anular', 'AnularSalidaController');
    Route::get('cliente/{id}/cronograma', 'GetCollectionByClienteController');

});
