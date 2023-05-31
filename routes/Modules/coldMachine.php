<?php

use Illuminate\Support\Facades\Route;


//Route::namespace('Api\Cold\ColdMachineModel')->middleware('auth:api')->group( function (){
Route::namespace('Api\Cold\ColdMachineModel')->middleware('auth:api')->group( function (){
    // Route::get('cold-machine-model/{id}', 'GetController');
    Route::delete('cold-machine-model/{id}', [App\Http\Controllers\Api\Cold\ColdMachineModel\DeleteController::class]);
//    Route::put('cold-machine-model/{id}/trash', 'TrashController');
//    Route::put('cold-machine-model/{id}/restore', 'RestoreController');
//    Route::post('cold-machine-model', 'CreateController');
//    Route::put('cold-machine-model/{id}', 'UpdateController');
//
//    Route::get('cold-machine-models', 'GetCollectionController');
//    Route::get('cold-machine-models/trashed', 'GetCollectionTrashedController');
});

//Route::namespace('Api\Cold\ColdMachineModel')->middleware('auth:api')->group( function (){
//Route::namespace('Api\Cold\ColdMachine')->middleware('auth:api')->group( function (){
//    //Route::get('cold-machine-model/{id}', 'GetController');
//    //Route::delete('cold-machine/{id}', 'DeleteController');
//    Route::put('cold-machine/{id}/trash', 'TrashController');
//    Route::put('cold-machine/{id}/restore', 'RestoreController');
//    Route::post('cold-machine', 'CreateController');
//    Route::put('cold-machine/{id}', 'UpdateController');
//
//    Route::get('cold-machines', 'GetCollectionController');
//    Route::get('cold-machines/{idClient}', 'GetCollectionByClientController');
//    Route::get('cold-machines/client/{idClient}/realTime', 'GetRealTimeByClientController');
//    Route::get('cold-machines/trashed', 'GetCollectionTrashedController');
//});

////Route::namespace('Api\Cold\ColdMachineModel')->middleware('auth:api')->group( function (){
//Route::namespace('Api\Cold\ColdMachineAlert')->middleware('auth:api')->group( function (){
//    //Route::get('cold-machine-model/{id}', 'GetController');
//    Route::delete('cold-machine-alert/{id}', 'DeleteController');
//    Route::put('cold-machine-alert/{id}/trash', 'TrashController');
//    Route::put('cold-machine-alert/{id}/restore', 'RestoreController');
//    Route::post('cold-machine-alert', 'CreateController');
//    Route::put('cold-machine-alert/{id}', 'UpdateController');
//
//    Route::get('cold-machine-alerts', 'GetCollectionController');
//    Route::get('cold-machine-alerts/trashed', 'GetCollectionTrashedController');
//});
//
////Route::namespace('Api\Cold\ColdMachineModel')->middleware('auth:api')->group( function (){
//Route::namespace('Api\Cold\ColdMachineAlertHistory')->middleware('auth:api')->group( function (){
//    Route::get('cold-machine-alert/histories/client/{idClient}/{dateStart}/{dateEnd}', 'GetCollectionByClientController');
//    Route::get('cold-machine-alert/histories/client/{idClient}/last', 'GetLastByClientController');
//    Route::get('cold-machine-alert/histories/client/{idClient}/count', 'CountByClientController');
//    Route::put('cold-machine-alert/history/{id}', 'UpdateController');
//});
//
////Route::namespace('Api\Cold\ColdMachineModel')->middleware('auth:api')->group( function (){
//Route::namespace('Api\Cold\ColdMachineHistory')->group( function (){
//    Route::get('cold-machine-history', 'CreateController');
//    Route::get('cold-machine-history/levelFuel/{dateStart}/{dateEnd}/{imei}', 'GetHistoryLevelFuelController')->middleware('auth:api');
//    Route::get('cold-machine-history/levelOutput/{dateStart}/{dateEnd}/{imei}', 'GetHistoryLevelOutputController')->middleware('auth:api');
//    Route::get('cold-machine-history/temperatureMotor/{dateStart}/{dateEnd}/{imei}', 'GetHistoryTemperatureMotorController')->middleware('auth:api');
//});
//
//
////Route::namespace('Api\Cold\ColdMachineModel')->middleware('auth:api')->group( function (){
//Route::namespace('Api\Cold\ColdMachineRealTime')->middleware('auth:api')->group( function (){
//    Route::get('cold-machine/real-time/client/{idClient}', 'GetCollectionByClientController');
//});
