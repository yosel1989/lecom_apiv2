<?php
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\Api\General\Vehicle')->middleware('auth:sanctum')->group( function (){
    Route::get('user/vehicles', 'GetVehiclesByUserController');
    Route::get('vehicle/{id}', 'GetVehicleController');
});


Route::namespace('App\Http\Controllers\Api\General\Vehicle')->group( function (){
    Route::get('app/vehicle/{plate}/{idClient}', 'GetVehicleByPlateController');
});


