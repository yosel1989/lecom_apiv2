<?php
use Illuminate\Support\Facades\Route;


Route::post('V2/login', [App\Http\Controllers\Api\V2\AuthController::class, 'login']);
