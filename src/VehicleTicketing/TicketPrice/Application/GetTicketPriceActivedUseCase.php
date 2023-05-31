<?php


namespace Src\VehicleTicketing\TicketPrice\Application;


use Src\VehicleTicketing\TicketPrice\Domain\Contracts\TicketPriceRepositoryContract;
use Src\VehicleTicketing\TicketPrice\Domain\TicketPrice;
use Src\VehicleTicketing\TicketPrice\Domain\ValueObjects\TicketPriceId;

final class GetTicketPriceActivedUseCase
{
    private $repository;

    public function __construct(TicketPriceRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $ticketPriceId): ?TicketPrice
    {
        $id = new TicketPriceId($ticketPriceId);

        return $this->repository->find($id);
    }
}
