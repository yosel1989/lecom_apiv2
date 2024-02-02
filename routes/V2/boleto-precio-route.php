<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\BoletoPrecio')->middleware('auth:sanctum')->group( function (){
    Route::get('cliente/{id}/boleto-precio/ruta/{idRuta}', 'GetCollectionByClienteController');
    Route::get('cliente/{id}/ruta/{idRuta}/boleto-precio/listado', 'GetListByClienteByRutaController');
    Route::get('cliente/{id}/boleto-precio/listado', 'GetListByClienteController');
    Route::post('cliente/{id}/boleto-precio', 'CreateController');
    Route::post('boleto-precio/{id}/cambiar-estado', 'ChangeStateController');
    Route::post('boleto-precio/{id}/cambiar-predeterminado', 'ChangePredeterminadoController');
    Route::get('boleto-precio/{id}', 'FindByIdController');
    Route::put('boleto-precio/{id}', 'UpdateController');
});

