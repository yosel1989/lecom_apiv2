<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\ClienteMedioPago')->middleware('auth:sanctum')->group( function (){
    Route::get('cliente/{id}/medio-pago', 'GetCollectionController');
    Route::put('cliente/{id}/medio-pago/{idMedioPago}/cambiar-estado', 'ChangeStateController');
});
