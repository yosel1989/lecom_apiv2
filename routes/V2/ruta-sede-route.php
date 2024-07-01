<?php
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\Api\V2\RutaSede')->middleware('auth:sanctum')->group( function (){
    Route::post('ruta-sede', 'AssignController');
    Route::get('ruta-sede/cliente/{id}/ruta/{idRuta}', 'GetCollectionByClienteRutaController');
});
