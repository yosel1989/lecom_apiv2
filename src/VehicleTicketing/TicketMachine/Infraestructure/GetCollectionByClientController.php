<?php


namespace Src\VehicleTicketing\TicketMachine\Infraestructure;

use Illuminate\Http\Request;
use Src\VehicleTicketing\TicketMachine\Application\GetCollectionByClientUseCase;
use Src\VehicleTicketing\TicketMachine\Infraestructure\Repositories\EloquentTicketMachineRepository;

final class GetCollectionByClientController
{
    private $repository;

    public function __construct(EloquentTicketMachineRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request): array
    {
        $idClient = $request->id;

        $useCase = new GetCollectionByClientUseCase($this->repository);
        return $useCase->__invoke($idClient);
    }
}
