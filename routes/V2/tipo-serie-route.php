<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\TipoSerie')->middleware('auth:sanctum')->group( function (){
    Route::get('tipo-serie/listado', 'GetListController');
});
