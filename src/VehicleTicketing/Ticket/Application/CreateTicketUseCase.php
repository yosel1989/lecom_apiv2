<?php


namespace Src\VehicleTicketing\Ticket\Application;


use Src\VehicleTicketing\Ticket\Domain\Contracts\TicketRepositoryContract;
use Src\VehicleTicketing\Ticket\Domain\Ticket;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketCode;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketDate;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketDeleted;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketId;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketIdClient;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketIdMachine;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketIdPrice;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketIdType;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketIdVehicle;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketLatitude;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketLongitude;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketTurn;

final class CreateTicketUseCase
{
    /**
     * @var TicketRepositoryContract
     */
    private $repository;

    public function __construct( TicketRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $ticketId,
        int $ticketCode,
        string $ticketDate,
        float $ticketLatitude,
        float $ticketLongitude,
        int $ticketTurn,
        int $ticketDeleted,
        string $ticketIdClient,
        string $ticketIdVehicle,
        string $ticketIdMachine,
        string $ticketIdPrice,
        string $ticketIdType
    ): void
    {
        $id            = new TicketId($ticketId);
        $code          = new TicketCode($ticketCode);
        $date          = new TicketDate($ticketDate);
        $latitude      = new TicketLatitude($ticketLatitude);
        $longitude     = new TicketLongitude($ticketLongitude);
        $deleted       = new TicketDeleted($ticketDeleted);
        $turn          = new TicketTurn($ticketTurn);
        $idClient      = new TicketIdClient($ticketIdClient);
        $idVehicle     = new TicketIdVehicle($ticketIdVehicle);
        $idMachine     = new TicketIdMachine($ticketIdMachine);
        $idPrice       = new TicketIdPrice($ticketIdPrice);
        $idType        = new TicketIdType($ticketIdType);

        $ticket = Ticket::create( $id, $code, $date, $latitude, $longitude, $turn, $deleted, $idClient, $idVehicle, $idMachine, $idPrice, $idType );
        $this->repository->save( $ticket );

    }
}
