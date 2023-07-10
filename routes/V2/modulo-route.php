<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\Modulo')->middleware('auth:sanctum')->group( function (){
    Route::get('modulo', 'GetCollectionController');
    Route::get('modulo/listado', 'GetListController');
    Route::post('modulo', 'CreateController');
    Route::post('modulo/{id}/cambiar-estado', 'ChangeStateController');
    Route::get('modulo/{id}', 'FindByIdController');
    Route::put('modulo/{id}', 'UpdateController');
});
