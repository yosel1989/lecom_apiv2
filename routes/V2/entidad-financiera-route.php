<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\EntidadFinanciera')->middleware('auth:sanctum')->group( function (){
    Route::get('entidad-financiera/listado', 'GetListController');
});
