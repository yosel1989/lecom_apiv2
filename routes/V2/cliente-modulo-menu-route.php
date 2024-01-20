<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\ClienteModuloMenu')->middleware('auth:sanctum')->group( function (){
    Route::get('cliente/{id}/modulo/{idModulo}/menu', 'GetCollectionByClienteController');
    Route::post('cliente/{id}/cliente-modulo-menu', 'AssignController');
});
