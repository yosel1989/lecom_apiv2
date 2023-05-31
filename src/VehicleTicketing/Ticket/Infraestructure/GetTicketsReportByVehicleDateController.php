<?php


namespace Src\VehicleTicketing\Ticket\Infraestructure;



use Illuminate\Http\Request;
use Src\VehicleTicketing\Ticket\Application\GetTicketsReportByVehicleDateUseCase;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketIdVehicle;
use Src\VehicleTicketing\Ticket\Infraestructure\Repositories\EloquentTicketRepository;

final class GetTicketsReportByVehicleDateController
{
    private $repository;

    public function __construct(EloquentTicketRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request )
    {
        $start = $request->input('start');
        $end = $request->input('end');
        $idVehicle = new TicketIdVehicle($request->input('idVehicle'));

        $getTicketsTicketsReportByVehicleDateUseCase = new GetTicketsReportByVehicleDateUseCase($this->repository);
        return $getTicketsTicketsReportByVehicleDateUseCase->__invoke($idVehicle,$start,$end);
    }
}
