<?php


namespace Src\VehicleTicketing\TicketMachine\Infraestructure;


use Illuminate\Http\Request;
use Src\VehicleTicketing\TicketMachine\Application\GetTicketMachineUseCase;
use Src\VehicleTicketing\TicketMachine\Infraestructure\Repositories\EloquentTicketMachineRepository;

final class GetTicketMachineController
{
    private $repository;

    public function __construct(EloquentTicketMachineRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request)
    {
        $ticketMachineId = $request->id;

        $getTicketImeiUseCase = new GetTicketMachineUseCase($this->repository);
        return $getTicketImeiUseCase->__invoke($ticketMachineId);
    }
}
