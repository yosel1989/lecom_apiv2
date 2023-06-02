<?php
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\Api\TransportePersonal\Paradero')->middleware('auth:api')->group( function (){
    Route::post('transporte-personal/paradero', 'CreateController');
    Route::put('transporte-personal/paradero/{id}', 'UpdateController');
    Route::get('transporte-personal/paradero/cliente/{id}', 'GetCollectionByClientController');
    Route::get('transporte-personal/paradero/cliente/{id}/lista', 'GetListByClientController');
    Route::put('transporte-personal/paradero/{id}/horas', 'AssignHoursController');
    Route::get('transporte-personal/paradero/{id}/horas', 'GetListHoursByIdController');
});

Route::namespace('App\Http\Controllers\Api\TransportePersonal\TipoRuta')->middleware('auth:api')->group( function (){
    Route::post('transporte-personal/tipo-ruta', 'CreateController');
    Route::put('transporte-personal/tipo-ruta/{id}', 'UpdateController');
    Route::get('transporte-personal/tipo-ruta/cliente/{id}', 'GetCollectionByClientController');
    Route::put('transporte-personal/tipo-ruta/{id}/paraderos', 'AssignPointsController');
    Route::get('transporte-personal/tipo-ruta/{id}/paraderos', 'GetListPointsByIdController');
});

Route::namespace('App\Http\Controllers\Api\TransportePersonal\Ruta')->middleware('auth:api')->group( function (){
    Route::post('transporte-personal/ruta', 'CreateController');
    Route::put('transporte-personal/ruta/{id}', 'UpdateController');
    Route::get('transporte-personal/ruta/cliente/{id}', 'GetCollectionByClientController');
    Route::put('transporte-personal/ruta/{id}/paraderos', 'AssignPointsController');
    Route::get('transporte-personal/ruta/{id}/paraderos', 'GetListPointsByIdController');
    Route::put('transporte-personal/ruta/{id}/vehiculos', 'AssignVehiclesController');
    Route::get('transporte-personal/ruta/{id}/vehiculos', 'GetListVehiclesByIdController');
});

Route::namespace('App\Http\Controllers\Api\TransportePersonal\Reporte')->middleware('auth:api')->group( function (){
    Route::get('transporte-personal/reporte/cliente/{id}/{fechaDesde}/{fechaHasta}', 'GetReporteByClientController');
});



Route::namespace('App\Http\Controllers\Api\TransportePersonal\Ruta')->group( function (){
    Route::get('app/transporte-personal/ruta/cliente/{id}', 'GetCollectionByClientController');
    Route::get('app/transporte-personal/ruta/{id}/paraderos', 'GetListPointsByIdController');
    Route::get('app/transporte-personal/ruta/vehiculo/{placa}', 'FindVehicleByPlateController');
});
Route::namespace('App\Http\Controllers\Api\TransportePersonal\TipoRuta')->group( function (){
    Route::get('app/transporte-personal/tipo-ruta/cliente/{id}', 'GetCollectionByClientController');
    Route::get('app/transporte-personal/tipo-ruta/{id}/paraderos', 'GetListPointsByIdController');
});
Route::namespace('App\Http\Controllers\Api\TransportePersonal\AbordajeDestino')->group( function (){
    Route::post('app/transporte-personal/abordaje-destino', 'CreateController');
});
Route::namespace('App\Http\Controllers\Api\TransportePersonal\ParaderoHora')->group( function (){
    Route::get('app/transporte-personal/paradero-hora/ruta/{id}/horas', 'GetListHoursByRouteController');
});


