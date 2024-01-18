<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\OrigenBoleto')->middleware('auth:sanctum')->group( function (){
    Route::get('origen-boleto/listado', 'GetListController');
});
