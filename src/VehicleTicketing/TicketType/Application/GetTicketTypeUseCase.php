<?php


namespace Src\VehicleTicketing\TicketType\Application;


use Src\VehicleTicketing\TicketType\Domain\Contracts\TicketTypeRepositoryContract;
use Src\VehicleTicketing\TicketType\Domain\TicketType;
use Src\VehicleTicketing\TicketType\Domain\ValueObjects\TicketTypeId;

final class GetTicketTypeUseCase
{
    private $repository;

    public function __construct(TicketTypeRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $ticketTypeId): ?TicketType
    {
        $id = new TicketTypeId($ticketTypeId);

        return $this->repository->find($id);
    }
}
