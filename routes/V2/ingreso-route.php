<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\Ingreso')->middleware('auth:sanctum')->group( function (){
    Route::post('cliente/ingreso', 'CreateController');
    Route::get('cliente/{id}/ingreso/reporte-despacho/usuario', 'GetReporteDespachoByClienteController');
    Route::get('cliente/{idCliente}/ingreso/{id}', 'FindByIdController');
    Route::post('cliente/{id}/ingreso/reporte', 'GetReporteByClienteController');
});

//Route::namespace('App\Http\Controllers\Api\V2\Ingreso')->group( function (){
//    Route::get('ingreso-pdf', 'PdfController');
//
//});
