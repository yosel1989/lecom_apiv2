<?php
use Illuminate\Support\Facades\Route;


Route::post('V2/login', [App\Http\Controllers\Api\V2\AuthController::class, 'login']);

Route::post('V2/logout', [App\Http\Controllers\Api\V2\AuthController::class, 'logout'])->middleware('auth:sanctum');
