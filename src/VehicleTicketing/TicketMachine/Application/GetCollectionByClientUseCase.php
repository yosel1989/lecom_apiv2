<?php


namespace Src\VehicleTicketing\TicketMachine\Application;

use Src\ModelBase\Domain\ValueObjects\Id;
use Src\VehicleTicketing\TicketMachine\Domain\Contracts\TicketMachineRepositoryContract;


final class GetCollectionByClientUseCase
{
    private $repository;

    public function __construct(TicketMachineRepositoryContract $repository)
    {
        $this->repository = $repository;
    }


    public function __invoke(
        string $idClient
    ): array
    {
        $_idClient = new Id($idClient, false, 'El id del cliente no tiene el formato correcto');

        return $this->repository->collectionByClient( $_idClient );
    }
}
