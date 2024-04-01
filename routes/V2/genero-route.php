<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\Genero')->middleware('auth:sanctum')->group( function (){
    Route::get('genero/listado', 'GetListController');
});
