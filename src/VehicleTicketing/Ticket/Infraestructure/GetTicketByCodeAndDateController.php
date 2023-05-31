<?php


namespace Src\VehicleTicketing\Ticket\Infraestructure;



use Src\VehicleTicketing\Ticket\Application\GetTicketByCodeAndDateUseCase;
use Src\VehicleTicketing\Ticket\Application\GetTicketsReportByVehicleDateUseCase;
use Src\VehicleTicketing\Ticket\Domain\Ticket;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketIdVehicle;
use Src\VehicleTicketing\Ticket\Infraestructure\Repositories\EloquentTicketRepository;

final class GetTicketByCodeAndDateController
{
    private $repository;

    public function __construct(EloquentTicketRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $codeTicket, string $dateTicket ) : ?Ticket
    {
        $getTicketByCodeAndDateUseCase = new GetTicketByCodeAndDateUseCase($this->repository);
        return $getTicketByCodeAndDateUseCase->__invoke($codeTicket,$dateTicket);
    }
}
