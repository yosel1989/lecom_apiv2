<?php


namespace Src\VehicleTicketing\TicketType\Application;


use Src\VehicleTicketing\TicketType\Domain\Contracts\TicketTypeRepositoryContract;

final class GetTicketTypeCollectionUseCase
{
    private $repository;

    public function __construct(TicketTypeRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        return $this->repository->collection();
    }
}
