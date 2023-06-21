<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\TransporteInterprovincial\Destino')->middleware('auth:sanctum')->group( function (){
    Route::post('/tpi/destino', 'CreateController');
    Route::put('/tpi/destino/{id}', 'UpdateController');
    Route::get('/tpi/destino/cliente/{id}', 'GetCollectionByClientController');
    Route::get('/tpi/destino/cliente/{id}/lista', 'GetListByClientController');
});
