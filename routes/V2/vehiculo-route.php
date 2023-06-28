<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\Vehiculo')->middleware('auth:sanctum')->group( function (){
    Route::get('cliente/{id}/vehiculos', 'GetCollectionByClienteController');
});
