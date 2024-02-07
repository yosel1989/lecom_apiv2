<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\TipoComprobante')->middleware('auth:sanctum')->group( function (){
    Route::get('tipo-comprobante/listado', 'GetListController');
    Route::get('tipo-comprobante/listado-punto-venta', 'GetListPuntoVentaController');
    Route::get('tipo-comprobante/listado-despacho', 'GetListDespachoController');
});
