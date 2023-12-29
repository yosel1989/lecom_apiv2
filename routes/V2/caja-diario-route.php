<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\CajaDiario')->middleware('auth:sanctum')->group( function (){
    Route::post('app/caja/abrir', 'OpenController');
    Route::put('app/caja/cerrar', 'CloseController');
});


Route::namespace('App\Http\Controllers\Api\V2\CajaDiario')->middleware('auth:sanctum')->group( function (){
    Route::post('caja-diario/abrir', 'AbrirController');
    Route::put('caja-diario/cerrar', 'CerrarController');
});
