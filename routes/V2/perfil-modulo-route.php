<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\PerfilModulo')->middleware('auth:sanctum')->group( function (){
    Route::get('cliente/{id}/perfil/{idPerfil}/collection', 'GetCollectionByClientePerfilController');
    Route::post('cliente/{id}/perfil-modulo', 'AssignController');
});
