<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\TipoDocumento')->middleware('auth:sanctum')->group( function (){
    Route::get('tipo-documento/listado', 'GetListController');
});
