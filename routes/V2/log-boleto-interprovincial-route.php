<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\LogBoletoInterprovincial')->middleware('auth:sanctum')->group( function (){
    Route::get('cliente/{id}/log-boleto-interprovincial', 'GetCollectionByClienteController');
});
