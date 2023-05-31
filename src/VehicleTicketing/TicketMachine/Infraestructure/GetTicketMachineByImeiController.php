<?php


namespace Src\VehicleTicketing\TicketMachine\Infraestructure;


use Illuminate\Http\Request;
use Src\VehicleTicketing\TicketMachine\Application\GetTicketMachineByImeiUseCase;
use Src\VehicleTicketing\TicketMachine\Infraestructure\Repositories\EloquentTicketMachineRepository;

final class GetTicketMachineByImeiController
{
    private $repository;

    public function __construct(EloquentTicketMachineRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request )
    {
        $TicketMachineImei = $request->imei;
        $getTicketMachineByImeiUseCase = new GetTicketMachineByImeiUseCase($this->repository);
        return $getTicketMachineByImeiUseCase->__invoke($TicketMachineImei);
    }
}
