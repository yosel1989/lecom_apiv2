<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\TipoPago')->middleware('auth:sanctum')->group( function (){
    Route::get('tipo-pago/listado', 'GetListController');
});
