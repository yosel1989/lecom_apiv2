<?php


namespace Src\VehicleTicketing\Ticket\Application;


use Src\VehicleTicketing\Ticket\Domain\Contracts\TicketRepositoryContract;

final class GetTicketProductionRanckingOfFleetByDateByTypeUseCase
{
    private $repository;

    public function __construct(TicketRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $start, string $end, array $fleet ): array
    {
        return $this->repository->getTicketProductionRanckingOfFleetByDateByTicketTypeWithRelations( $start, $end, $fleet, ['idClient_pk','idVehicle_pk','idType_pk'] );
    }

}
