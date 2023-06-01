<?php

use Illuminate\Support\Facades\Route;


//Route::namespace('Api\Cold\ColdMachineModel')->middleware('auth:api')->group( function (){
Route::namespace('Api\Cold\ColdMachineModel')->prefix('Api\Cold\ColdMachineModel')->middleware('auth:api')->group( function (){
//     Route::get('cold-machine-model/{id}', App\Http\Controllers\Api\Cold\ColdMachineModel\GetController::class);
    Route::delete('cold-machine-model/{id}', ['DeleteController::class']);
    Route::put('cold-machine-model/{id}/trash', [App\Http\Controllers\Api\Cold\ColdMachineModel\TrashController::class]);
    Route::put('cold-machine-model/{id}/restore', [App\Http\Controllers\Api\Cold\ColdMachineModel\RestoreController::class]);
    Route::post('cold-machine-model', [App\Http\Controllers\Api\Cold\ColdMachineModel\CreateController::class]);
    Route::put('cold-machine-model/{id}', [App\Http\Controllers\Api\Cold\ColdMachineModel\UpdateController::class]);

    Route::get('cold-machine-models', [App\Http\Controllers\Api\Cold\ColdMachineModel\GetCollectionController::class]);
    Route::get('cold-machine-models/trashed', [App\Http\Controllers\Api\Cold\ColdMachineModel\GetCollectionTrashedController::class]);
});

//Route::namespace('Api\Cold\ColdMachineModel')->middleware('auth:api')->group( function (){
Route::namespace('Api\Cold\ColdMachine')->middleware('auth:api')->group( function (){
    //Route::get('cold-machine-model/{id}', 'GetController::class);
    //Route::delete('cold-machine/{id}', 'DeleteController::class);
    Route::put('cold-machine/{id}/trash', App\Http\Controllers\Api\Cold\ColdMachine\TrashController::class);
    Route::put('cold-machine/{id}/restore', App\Http\Controllers\Api\Cold\ColdMachine\RestoreController::class);
    Route::post('cold-machine', App\Http\Controllers\Api\Cold\ColdMachine\CreateController::class);
    Route::put('cold-machine/{id}', App\Http\Controllers\Api\Cold\ColdMachine\UpdateController::class);

    Route::get('cold-machines', App\Http\Controllers\Api\Cold\ColdMachine\GetCollectionController::class);
    Route::get('cold-machines/{idClient}', App\Http\Controllers\Api\Cold\ColdMachine\GetCollectionByClientController::class);
    Route::get('cold-machines/client/{idClient}/realTime', App\Http\Controllers\Api\Cold\ColdMachine\GetRealTimeByClientController::class);
    Route::get('cold-machines/trashed', App\Http\Controllers\Api\Cold\ColdMachine\GetCollectionTrashedController::class);
});

//Route::namespace('Api\Cold\ColdMachineModel')->middleware('auth:api')->group( function (){
Route::namespace('Api\Cold\ColdMachineAlert')->middleware('auth:api')->group( function (){
    //Route::get('cold-machine-model/{id}', 'GetController::class);
    Route::delete('cold-machine-alert/{id}', App\Http\Controllers\Api\Cold\ColdMachineAlert\DeleteController::class);
    Route::put('cold-machine-alert/{id}/trash', App\Http\Controllers\Api\Cold\ColdMachineAlert\TrashController::class);
    Route::put('cold-machine-alert/{id}/restore', App\Http\Controllers\Api\Cold\ColdMachineAlert\RestoreController::class);
    Route::post('cold-machine-alert', App\Http\Controllers\Api\Cold\ColdMachineAlert\CreateController::class);
    Route::put('cold-machine-alert/{id}', App\Http\Controllers\Api\Cold\ColdMachineAlert\UpdateController::class);

    Route::get('cold-machine-alerts', App\Http\Controllers\Api\Cold\ColdMachineAlert\GetCollectionController::class);
    Route::get('cold-machine-alerts/trashed', App\Http\Controllers\Api\Cold\ColdMachineAlert\GetCollectionTrashedController::class);
});

//Route::namespace('Api\Cold\ColdMachineModel')->middleware('auth:api')->group( function (){
Route::namespace('Api\Cold\ColdMachineAlertHistory')->middleware('auth:api')->group( function (){
    Route::get('cold-machine-alert/histories/client/{idClient}/{dateStart}/{dateEnd}', App\Http\Controllers\Api\Cold\ColdMachineAlertHistory\GetCollectionByClientController::class);
    Route::get('cold-machine-alert/histories/client/{idClient}/last', App\Http\Controllers\Api\Cold\ColdMachineAlertHistory\GetLastByClientController::class);
    Route::get('cold-machine-alert/histories/client/{idClient}/count', App\Http\Controllers\Api\Cold\ColdMachineAlertHistory\CountByClientController::class);
    Route::put('cold-machine-alert/history/{id}', App\Http\Controllers\Api\Cold\ColdMachineAlertHistory\UpdateController::class);
});

//Route::namespace('Api\Cold\ColdMachineModel')->middleware('auth:api')->group( function (){
Route::namespace('Api\Cold\ColdMachineHistory')->group( function (){
    Route::get('cold-machine-history', App\Http\Controllers\Api\Cold\ColdMachineHistory\CreateController::class);
    Route::get('cold-machine-history/levelFuel/{dateStart}/{dateEnd}/{imei}', App\Http\Controllers\Api\Cold\ColdMachineHistory\GetHistoryLevelFuelController::class)->middleware('auth:api');
    Route::get('cold-machine-history/levelOutput/{dateStart}/{dateEnd}/{imei}', App\Http\Controllers\Api\Cold\ColdMachineHistory\GetHistoryLevelOutputController::class)->middleware('auth:api');
    Route::get('cold-machine-history/temperatureMotor/{dateStart}/{dateEnd}/{imei}', App\Http\Controllers\Api\Cold\ColdMachineHistory\GetHistoryTemperatureMotorController::class)->middleware('auth:api');
});


//Route::namespace('Api\Cold\ColdMachineModel')->middleware('auth:api')->group( function (){
Route::namespace('Api\Cold\ColdMachineRealTime')->middleware('auth:api')->group( function (){
    Route::get('cold-machine/real-time/client/{idClient}', App\Http\Controllers\Api\Cold\ColdMachineRealTime\GetCollectionByClientController::class);
});
