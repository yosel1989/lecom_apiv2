<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\Modulo')->middleware('auth:sanctum')->group( function (){
    Route::get('modulo', 'GetCollectionController');
    Route::get('modulo/listado', 'GetListController');
    Route::get('modulo/listado/perfil/{idPerfil}', 'GetListToPerfilController');
    Route::get('modulo/listado/cliente/{idCliente}', 'GetListToClienteController');
    Route::get('modulo/listado/usuario-perfil/{idPerfil}', 'GetListToUsuarioPerfilController');
    Route::post('modulo', 'CreateController');
    Route::post('modulo/{id}/cambiar-estado', 'ChangeStateController');
    Route::get('modulo/{id}', 'FindByIdController');
    Route::put('modulo/{id}', 'UpdateController');
});
