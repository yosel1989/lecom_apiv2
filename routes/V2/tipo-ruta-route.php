<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\TipoRuta')->middleware('auth:sanctum')->group( function (){
    Route::get('tipo-ruta/listado', 'GetListController');
});
