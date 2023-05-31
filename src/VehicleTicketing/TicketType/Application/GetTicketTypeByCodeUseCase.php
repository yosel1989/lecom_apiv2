<?php


namespace Src\VehicleTicketing\TicketType\Application;


use Src\VehicleTicketing\TicketType\Domain\Contracts\TicketTypeRepositoryContract;
use Src\VehicleTicketing\TicketType\Domain\TicketType;
use Src\VehicleTicketing\TicketType\Domain\ValueObjects\TicketTypeCode;

final class GetTicketTypeByCodeUseCase
{
    private $repository;

    public function __construct(TicketTypeRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $ticketTypeCode): ?TicketType
    {
        $code = new TicketTypeCode($ticketTypeCode);

        return $this->repository->findByCode($code);
    }
}
