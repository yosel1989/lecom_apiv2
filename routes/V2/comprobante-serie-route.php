<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\ComprobanteSerie')->middleware('auth:sanctum')->group( function (){
    Route::get('cliente/{id}/comprobante-serie', 'GetCollectionByClienteController');
    Route::get('cliente/{id}/comprobante-serie/listado', 'GetListByClienteController');
    Route::post('cliente/{id}/comprobante-serie', 'CreateController');
    Route::post('comprobante-serie/{id}/cambiar-estado', 'ChangeStateController');
    Route::get('comprobante-serie/{id}', 'FindByIdController');
    Route::put('comprobante-serie/{id}', 'UpdateController');
});
