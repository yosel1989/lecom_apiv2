<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\BoletoInterprovincial')->middleware('auth:sanctum')->group( function (){
    Route::get('cliente/{id}/boleto-interprovincial', 'GetCollectionByClienteController');
    Route::post('boleto-interprovincial/{id}/cambiar-estado', 'ChangeStateController');
    Route::get('boleto-interprovincial/{id}', 'FindByIdController');
});
