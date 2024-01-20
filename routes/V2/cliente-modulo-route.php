<?php
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\Api\V2\ClienteModulo')->middleware('auth:sanctum')->group( function (){
    Route::post('cliente/{id}/cliente-modulo', 'AssignController');
});
