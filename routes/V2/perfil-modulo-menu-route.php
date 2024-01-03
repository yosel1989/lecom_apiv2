<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\PerfilModuloMenu')->middleware('auth:sanctum')->group( function (){
    Route::get('cliente/{id}/perfil/{idPerfil}/modulo/{idModulo}/menu', 'GetCollectionByClientePerfilController');
    Route::get('cliente/{id}/perfil/{idPerfil}/modulo/{idModulo}/menu-usuario', 'GetCollectionByClientePerfilUsuarioController');
    Route::post('cliente/{id}/perfil-modulo-menu', 'AssignController');
});
