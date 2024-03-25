<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\CajaDiario')->middleware('auth:sanctum')->group( function (){
    Route::post('app/caja/abrir', 'OpenController');
    Route::put('app/caja/cerrar', 'CloseController');
});


Route::namespace('App\Http\Controllers\Api\V2\CajaDiario')->middleware('auth:sanctum')->group( function (){
    Route::get('cliente/{idCliente}/caja-diario/monto-actual/{idCaja}', 'MontoActualController');
    Route::post('caja-diario/abrir', 'AbrirController');
    Route::put('caja-diario/cerrar', 'CerrarController');
    Route::put('caja-diario/cerrar-despacho', 'CerrarCajaDespachoController');
    Route::get('cliente/{idCliente}/caja-diario/reporte/{fechaInicio}/{fechaFin}', 'ReporteController');
    Route::get('cliente/{idCliente}/caja-diario/reporte-saldo/{fechaInicio}/{fechaFin}/{idCaja}', 'ReporteSaldoController');
});
