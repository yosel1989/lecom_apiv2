<?php
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\V2\CronogramaSalida')->middleware('auth:sanctum')->group( function (){
    Route::post('cronograma-salida', 'CreateController');
    Route::get('cronograma-salida/{id}', 'FindByIdController');
    Route::put('cronograma-salida/{id}', 'UpdateController');
    Route::post('cronograma-salida/{id}/cambiar-estado', 'ChangeStateController');
//    Route::get('cliente/{id}/egreso/reporte-despacho/usuario', 'GetReporteDespachoByClienteController');
//    Route::post('cliente/{id}/egreso/reporte', 'GetReporteByClienteController');
//    Route::put('egreso/anular', 'AnularSalidaController');
    Route::get('cronograma-salida/cronograma/{id}', 'GetCollectionByCronogramaController');
    Route::get('cronograma-salida/ruta/{id}', 'GetCollectionByRutaController');
    Route::get('cronograma-salida/{id}/cliente/{idCliente}/asientos-disponibles', 'GetAsientosDisponiblesController');
    Route::get('cronograma-salida/vehiculo/{idVehiculo}/ruta/{idRuta}', 'GetListByVehiculoRutaFechaController');
    Route::get('cronograma-salida/list_A/{fecha}/{idRuta}/{idVehiculo}', 'GetListModelAController');

});
