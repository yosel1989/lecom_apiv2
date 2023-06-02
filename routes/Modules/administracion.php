<?php

use App\Http\Controllers\Exports\Pdf\liquidacion;
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\Api\Admin\Client')->group( function (){
    Route::get('client/{id}', 'GetClientController');
    Route::get('app/client/{id}', 'AppGetClientController');
    Route::delete('client/{id}', 'DeleteClientController');
    Route::put('client/{id}/trash', 'TrashClientController');
    Route::put('client/{id}/restore', 'RestoreClientController');
    Route::post('client', 'CreateClientController');
    Route::put('client/{id}', 'UpdateClientController');

    Route::get('clients', 'GetClientCollectionController');
    Route::get('clients/trashed', 'GetClientTrashCollectionController');
    Route::get('clients/parent/{parent}', 'GetClientCollectionByParentController');
    Route::get('clients/trashed/parent/{parent}', 'GetClientTrashCollectionByParentController');

});


Route::namespace('App\Http\Controllers\Api\Admin\User')->group( function (){
    Route::get('user/{id}', 'GetUserController');
    Route::delete('user/{id}', 'DeleteUserController');
    Route::put('user/{id}/trash', 'TrashUserController');
    Route::put('user/{id}/restore', 'RestoreUserController');
    Route::post('user', 'CreateUserController');
    Route::put('user/{id}', 'UpdateUserController');
    Route::get('client/{id}/users', 'GetUserCollectionByClientController');
    Route::get('client/{id}/users/trashed', 'GetUserTrashCollectionByClientController');

    Route::put('user/{id}/actived', 'UpdateActivedController');
    Route::put('user/{id}/password', 'UpdatePasswordController');
    Route::post('user/{id}/modules', 'AssignModulesController');
    Route::post('user/{id}/vehicles', 'AssignVehiclesController');

    Route::get('user/{id}/vehicles', 'GetVehicleCollectionByUserController');
});

Route::namespace('App\Http\Controllers\Api\Admin\VehicleBrand')->group( function (){
    Route::post('vehicle_brand', 'CreateVehicleBrandController');
    Route::put('vehicle_brand/{id}', 'UpdateVehicleBrandController');
    Route::delete('vehicle_brand/{id}', 'DeleteVehicleBrandController');
    Route::put('vehicle_brand/{id}/trash', 'TrashVehicleBrandController');
    Route::put('vehicle_brand/{id}/restore', 'RestoreVehicleBrandController');
    Route::get('vehicle_brands', 'GetVehicleBrandCollectionController');
    Route::get('vehicle_brands/trashed', 'GetVehicleBrandCollectionTrashedController');
});

Route::namespace('App\Http\Controllers\Api\Admin\VehicleModel')->group( function (){
    Route::post('vehicle_model', 'CreateVehicleModelController');
    Route::put('vehicle_model/{id}', 'UpdateVehicleModelController');
    Route::delete('vehicle_model/{id}', 'DeleteVehicleModelController');
    Route::put('vehicle_model/{id}/trash', 'TrashVehicleModelController');
    Route::put('vehicle_model/{id}/restore', 'RestoreVehicleModelController');
    Route::get('vehicle_models', 'GetVehicleModelCollectionController');
    Route::get('vehicle_models/trashed', 'GetVehicleModelCollectionTrashedController');

    Route::get('/brand/{id}/vehicle_models', 'GetCollectionByBrandController');

});

Route::namespace('App\Http\Controllers\Api\Admin\VehicleClass')->group( function (){
    Route::post('vehicle_class', 'CreateController');
    Route::put('vehicle_class/{id}', 'UpdateController');
    Route::delete('vehicle_class/{id}', 'DeleteController');
    Route::put('vehicle_class/{id}/trash', 'TrashController');
    Route::put('vehicle_class/{id}/restore', 'RestoreController');
    Route::get('vehicle_classes', 'GetCollectionController');
    Route::get('vehicle_classes/trashed', 'GetCollectionTrashedController');
});

Route::namespace('App\Http\Controllers\Api\Admin\OperatorPhone')->group( function (){
    Route::post('phone_operator', 'CreateController');
    Route::put('phone_operator/{id}', 'UpdateController');
    Route::delete('phone_operator/{id}', 'DeleteController');
    Route::put('phone_operator/{id}/trash', 'TrashController');
    Route::put('phone_operator/{id}/restore', 'RestoreController');
    Route::get('phone_operators', 'GetCollectionController');
    Route::get('phone_operators/trashed', 'GetCollectionTrashedController');
});

Route::namespace('App\Http\Controllers\Api\Admin\SimCard')->group( function (){
    Route::post('sim_card', 'CreateController');
    Route::put('sim_card/{id}', 'UpdateController');
    Route::delete('sim_card/{id}', 'DeleteController');
    Route::put('sim_card/{id}/trash', 'TrashController');
    Route::put('sim_card/{id}/restore', 'RestoreController');
    Route::get('sim_cards', 'GetCollectionController');
    Route::get('sim_cards/trashed', 'GetCollectionTrashedController');
    Route::get('phone_operator/{id}/sim_cards', 'GetCollectionByOperatorController');

    Route::get('client/{id}/sim_cards', 'GetCollectionByClientController');
    Route::get('client/{id}/sim_cards/trashed', 'GetCollectionTrashedByClientController');
});

Route::namespace('App\Http\Controllers\Api\Admin\GpsModel')->group( function (){
    Route::post('gps_model', 'CreateController');
    Route::put('gps_model/{id}', 'UpdateController');
    Route::delete('gps_model/{id}', 'DeleteController');
    Route::put('gps_model/{id}/trash', 'TrashController');
    Route::put('gps_model/{id}/restore', 'RestoreController');
    Route::get('gps_models', 'GetCollectionController');
    Route::get('gps_models/trashed', 'GetCollectionTrashedController');
});

Route::namespace('App\Http\Controllers\Api\Admin\Gps')->group( function (){
    Route::post('gps', 'CreateController');
    Route::put('gps/{id}', 'UpdateController');
    Route::delete('gps/{id}', 'DeleteController');
    Route::put('gps/{id}/trash', 'TrashController');
    Route::put('gps/{id}/restore', 'RestoreController');
    //Route::get('gpss', 'GetCollectionController');
    Route::get('gpses/trashed', 'GetCollectionTrashedController');
    Route::get('client/{id}/gpses', 'GetCollectionByClientController');
    Route::get('client/{id}/gpses/trashed', 'GetCollectionTrashedByClientController');
});

Route::namespace('App\Http\Controllers\Api\Admin\Vehicle')->group( function (){
    Route::post('vehicle', 'CreateController');
    Route::get('vehicle/{id}', 'FindController');
    Route::put('vehicle/{id}', 'UpdateController');
    Route::delete('vehicle/{id}', 'DeleteController');
    Route::put('vehicle/{id}/trash', 'TrashController');
    Route::put('vehicle/{id}/restore', 'RestoreController');

    Route::get('client/{id}/vehicles', 'GetVehicleCollectionByClientController');
    Route::get('vehiculo/cliente/{id}', 'GetCollectionActivedByClientController');
});

Route::namespace('App\Http\Controllers\Api\Admin\Ert')->group( function (){
    Route::post('ert', 'CreateController');
    Route::put('ert/{id}', 'UpdateController');
    Route::delete('ert/{id}', 'DeleteController');
    Route::put('ert/{id}/trash', 'TrashController');
    Route::put('ert/{id}/restore', 'RestoreController');

    Route::get('client/{id}/erts', 'GetCollectionByClientController');
    Route::put('ert/{id}/sutran', 'UpdateSutranController');
});

Route::namespace('App\Http\Controllers\Api\Admin\Module')->group( function (){
    /*Route::post('ert', 'CreateController');
    Route::put('ert/{id}', 'UpdateController');
    Route::delete('ert/{id}', 'DeleteController');
    Route::put('ert/{id}/trash', 'TrashController');
    Route::put('ert/{id}/restore', 'RestoreController');*/

    Route::get('modules', 'GetCollectionController');
});


Route::namespace('App\Http\Controllers\Api\Admin\TypeInvoicing')->group( function (){
    Route::post('invoicing_type', 'CreateController');
    Route::put('invoicing_type/{id}', 'UpdateController');
    Route::delete('invoicing_type/{id}', 'DeleteController');
    Route::put('invoicing_type/{id}/trash', 'TrashController');
    Route::put('invoicing_type/{id}/restore', 'RestoreController');
    Route::get('invoicing_types', 'GetCollectionController');
    Route::get('invoicing_types/trashed', 'GetCollectionTrashedController');
});
Route::namespace('App\Http\Controllers\Api\Admin\TypePay')->group( function (){
    Route::post('pay_type', 'CreateController');
    Route::put('pay_type/{id}', 'UpdateController');
    Route::delete('pay_type/{id}', 'DeleteController');
    Route::put('pay_type/{id}/trash', 'TrashController');
    Route::put('pay_type/{id}/restore', 'RestoreController');
    Route::get('pay_types', 'GetCollectionController');
    Route::get('pay_types/trashed', 'GetCollectionTrashedController');
});


// Administracion
Route::namespace('App\Http\Controllers\Api\Administracion\PersonalCategoria')->middleware('auth:api')->group( function (){
    Route::post('personal-categoria', 'CreateController');
    Route::put('personal-categoria/{id}', 'UpdateController');
    Route::get('personal-categoria', 'GetCollectionController');
    Route::get('personal-categoria/estado/activo', 'GetCollectionActivedController');
});

Route::namespace('App\Http\Controllers\Api\Administracion\Personal')->middleware('auth:api')->group( function (){
    Route::post('personal', 'CreateController');
    Route::put('personal/{id}', 'UpdateController');
    Route::get('personal/cliente/{id}', 'GetCollectionByClientController');
    Route::get('personal/cliente/{id}/categoria/{code}', 'GetCollectionByClientByCategoryController');
});


Route::namespace('App\Http\Controllers\Api\Administracion\Ruta')->middleware('auth:api')->group( function (){
    Route::post('ruta', 'CreateController');
    Route::put('ruta/{id}', 'UpdateController');
    Route::get('ruta/cliente/{id}', 'GetCollectionByClientController');
    Route::get('ruta/cliente/{id}/activo', 'GetCollectionActivedByClientController');
});
Route::namespace('App\Http\Controllers\Api\Administracion\HojaRuta')->middleware('auth:api')->group( function (){
    Route::post('hoja-ruta', 'CreateController');
    Route::put('hoja-ruta/{id}', 'UpdateController');
    Route::get('hoja-ruta/cliente/{id}', 'GetCollectionByClientController');
    Route::get('hoja-ruta/cliente/{id}/fecha/{fecha}', 'GetCollectionByClientByDateController');
});

Route::namespace('App\Http\Controllers\Api\Administracion\TipoIngreso')->middleware('auth:api')->group( function (){
    Route::post('tipo-ingreso', 'CreateController');
    Route::put('tipo-ingreso/{id}', 'UpdateController');
    Route::get('tipo-ingreso/cliente/{id}', 'GetCollectionByClientController');
    Route::get('tipo-ingreso/cliente/{id}/lista', 'GetListByClientController');
});

Route::namespace('App\Http\Controllers\Api\Administracion\TipoEgreso')->middleware('auth:api')->group( function (){
    Route::post('tipo-egreso', 'CreateController');
    Route::put('tipo-egreso/{id}', 'UpdateController');
    Route::get('tipo-egreso/cliente/{id}', 'GetCollectionByClientController');
    Route::get('tipo-egreso/cliente/{id}/lista', 'GetListByClientController');
});

Route::namespace('App\Http\Controllers\Api\Administracion\Ruta')->group( function (){
    Route::get('app/ruta/cliente/{id}/codigo/{codigo}', 'FindByClientByCodeController');
});

Route::namespace('App\Http\Controllers\Api\Administracion\Ingreso')->middleware('auth:api')->group( function (){
    Route::post('ingreso', 'CreateController');
    Route::put('ingreso/{id}', 'UpdateController');
    Route::get('ingreso/cliente/{id}', 'GetCollectionByClientController');
    Route::get('ingreso/cliente/{id}/{fecha}', 'GetCollectionByClientByDateController');
    Route::get('ingreso/cliente/{id}/vehiculo/{idVehiculo}/{fechaDesde}/{fechaHasta}', 'GetReportByClientController');

    Route::put('ingreso/{id}/anular', 'AnularController');
});

Route::namespace('App\Http\Controllers\Api\Administracion\Egreso')->middleware('auth:api')->group( function (){
    Route::post('egreso', 'CreateController');
    Route::put('egreso/{id}', 'UpdateController');
    Route::get('egreso/cliente/{id}', 'GetCollectionByClientController');
    Route::get('egreso/cliente/{id}/{fecha}', 'GetCollectionByClientByDateController');
    Route::get('egreso/cliente/{id}/vehiculo/{idVehiculo}/{fechaDesde}/{fechaHasta}', 'GetReportByClientController');

    Route::put('egreso/{id}/anular', 'AnularController');

});

Route::namespace('App\Http\Controllers\Api\Administracion\MotivoAnulacion')->middleware('auth:api')->group( function (){
    Route::post('motivo-anulacion', 'CreateController');
    Route::put('motivo-anulacion/{id}', 'UpdateController');
    Route::get('motivos-anulacion', 'GetCollectionController');
    Route::get('motivos-anulacion/list', 'GetListController');
});

Route::namespace('App\Http\Controllers\Api\Administracion\Liquidacion')->middleware('auth:api')->group( function (){
    Route::post('liquidacion', 'CreateController');
    Route::get('liquidacion/cliente/{id}', 'GetCollectionByClientController');
});


//Route::namespace('Api\Administracion\HojaRuta')->middleware('auth:api')->group( function (){
//    Route::post('hoja-ruta', 'CreateController');
//});



Route::get('liquidacion-bus/previsualizacion/pdf/{idCliente}/{fecha}/{idVehiculo}', [liquidacion::class, 'index']);
