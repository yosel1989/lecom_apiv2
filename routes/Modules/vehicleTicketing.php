<?php
use Illuminate\Support\Facades\Route;


Route::namespace('Api\VehicleTicketing\Ticket')->middleware('auth:api')->group( function (){
    Route::get('vehicle/{id}/tickets', 'GetTicketsTodayByVehicleController');
    Route::get('ticket/{id}', 'GetTicketController');
    Route::get('ticket/code/date', 'GetTicketByCodeAndDateController');
    Route::get('report/tickets', 'GetTicketsReportByVehicleDateController');
    Route::get('report/tickets/expired', 'GetTicketCollectionExpiredByDateByVehicleByTurnController');
    Route::get('user/report/tickets', 'GetTicketCollectionByUserOfDateController');
    Route::get('user/production/tickets', 'GetTicketProductionByDateOfFleetController');
    Route::get('user/production-rancking/tickets', 'GetTicketProductionRanckingOfFleetByDateController');
    Route::get('user/production-rancking/tickets/type', 'GetTicketProductionRanckingOfFleetByDateByTypeController');
});

Route::namespace('Api\VehicleTicketing\Ticket')->group( function (){
    Route::get('report/tickets/export', 'ExportTicketsReportByVehicleDateController');
});

Route::middleware('auth:api')->namespace('Api\VehicleTicketing\TicketType')->group( function (){
    Route::get('ticket/type/{id}', 'GetTicketTypeController');
    Route::get('ticket/type/code/{code}', 'GetTicketTypeByCodeController');
    Route::get('ticket/types/list', 'GetTicketTypeCollectionController');
});

Route::namespace('Api\VehicleTicketing\TicketPrice')->group( function (){
    Route::get('ticket/price/{id}', 'GetTicketPriceController');
    Route::get('ticket/price/{code}/{idClient}', 'GetTicketPriceByCriteriaController');
});

Route::namespace('Api\VehicleTicketing\TicketMachine')->group( function (){
    Route::get('ticket/machine/{id}', 'GetTicketMachineController');
    Route::get('ticket/machine/imei/{imei}', 'GetTicketMachineByImeiController');
});

Route::namespace('Api\VehicleTicketing\Ticket')->group( function (){
    Route::post('ticket/save', 'CreateTicketController');
});

Route::namespace('Api\VehicleTicketing\TicketMachine')->middleware('auth:api')->group( function (){
    Route::post('ticket-machine', 'CreateController');
    Route::put('ticket-machine/{id}', 'UpdateController');
    Route::get('client/{id}/ticket-machines', 'GetCollectionByClientController');
});

Route::namespace('Api\VehicleTicketing\Report')->middleware('auth:api')->group( function (){
    Route::get('v1/ticket-report/recaudo-total-por-vuelta/vehiculo/{idVehicle}/{date}', 'GetTotalByVehicleByTurnController');
    Route::get('v1/ticket-report/recaudo-total/{start}/{end}/{idVehicle}', 'GetTotalByVehicleByClientController');
    Route::get('v1/ticket-report/recaudo-top-total/{start}/{end}/{idClient}', 'GetTotalTopByVehicleByClientController');
    Route::get('v1/ticket-report/ranking-ticket-total/{idClient}/{start}/{end}', 'GetRankingTopTicketByClientController');
    Route::get('v1/ticket-report/recaudo-por-dia/cliente/{date}/{idClient}', 'GetTotalByClientByDateController');
    Route::get('v1/ticket-report/top-recaudo-por-dia/cliente/{date}/{idClient}/{hourStart}/{hourEnd}', 'GetTopTotalByClientByDateController');
    Route::get('v1/ticket-report/recaudo-total/vehiculo/{start}/{end}/{idVehicle}', 'GetTotalByVehicleDatesController');
    Route::get('v1/ticket-report/recaudo-por-dia/cliente/{start}/{end}/{idClient}', 'GetTotalByDayByClientController');
    Route::get('v1/ticket-report/recaudo-por-hora/vehiculo/{date}/{idVehicle}', 'GetTotalByVehicleHourController');
    Route::get('v1/ticket-report/recaudo-por-hora/cliente/{date}/{idClient}', 'GetTotalByClientHourController');
    Route::get('v1/ticket-report/recaudo-promedio-flota-por-hora/cliente/{idClient}/{dateStart}/{dateEnd}', 'GetTotalAverageByClientHourByRangeDateController');
    Route::get('v1/ticket-report/recaudo-promedio-top-flota-por-hora/cliente/{idClient}/{dateStart}/{dateEnd}/{hourStart}/{hourEnd}', 'GetTotalAverageTopByClientHourByRangeDateController');
    Route::get('v1/ticket-report/recaudo-promedio-por-hora/cliente/{dateStart}/{dateEnd}/{idClient}', 'GetTotalAverageByFleetHourController');
    Route::get('v1/ticket-report/recaudo-por-flota/cliente/{idClient}/{start}/{end}', 'GetTotalByFleetDateRangeController');
    Route::get('v1/tickets/vehiculo/{idVehicle}/{date}/{hourStart}/{hourEnd}', 'TicketsByVehicleRangeHourController');
    Route::get('v1/tickets/cliente/{idClient}/{date}/{hourStart}/{hourEnd}', 'TicketsByClientRangeHourController');
    Route::get('v1/tickets/flota/cliente/{idClient}/{dateStart}/{dateEnd}/{hourStart}/{hourEnd}', 'TicketsByClientFleetRangeHourController');
});

Route::namespace('Api\VehicleTicketing\Zbus\Ticket')->group( function (){
    Route::post('app/boletaje/registrar-boleto', 'RegistrarBoletoPorPlacaController');
});
