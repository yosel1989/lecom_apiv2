<?php


namespace Src\VehicleTicketing\Ticket\Application;


use Src\VehicleTicketing\Ticket\Domain\Contracts\TicketRepositoryContract;

final class GetTicketCollectionByUserOfDateUseCase
{
    private $repository;

    public function __construct(TicketRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $start, string $end, array $arrIdVehicle )
    {
        return $this->repository->getTicketCollectionByUserOfDateWithRelations($start,$end,$arrIdVehicle,['idClient_pk','idMachine_pk','idPrice_pk','idType_pk','idVehicle_pk']);
    }

}
