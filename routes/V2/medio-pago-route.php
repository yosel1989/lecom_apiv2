<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\MedioPago')->middleware('auth:sanctum')->group( function (){
    Route::get('medio-pago/despacho/listado', 'GetCollectionToDespachoController');
});
