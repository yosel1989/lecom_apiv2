<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\TipoMoneda')->middleware('auth:sanctum')->group( function (){
    Route::get('tipo-moneda/listado', 'GetListController');
});
