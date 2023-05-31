<?php


namespace Src\VehicleTicketing\Ticket\Domain\Contracts;


use Src\Auth\User\Domain\ValueObjects\UserId;
use Src\ModelBase\Domain\ValueObjects\DateOnlyFormat;
use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\VehicleTicketing\Ticket\Domain\Ticket;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketCode;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketDate;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketId;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketIdClient;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketIdVehicle;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketTurn;
use Src\VehicleTicketing\TicketMachine\Domain\ValueObjects\TicketMachineId;

interface TicketRepositoryContract
{
    public function find(TicketId $id): ?Ticket;

    public function findWithRelations( TicketId $id , array $relations ): ?Ticket;

    public function findByCodeDate( TicketCode $code, TicketDate $date , array $relations ): ?Ticket;

    public function findLastTicketByTicketMachine( TicketMachineId $idTicketMachine ): ?Ticket;

    public function getTicketsTodayByVehicleWithRelations( TicketIdVehicle $ticketIdVehicle, array $relations ): array;

    public function getTicketsReportByVehicleDateWithRelations( string $start, string $end, TicketIdVehicle $ticketIdVehicle, array $relations): array;

    public function getTicketCollectionByUserOfDateWithRelations( string $start , string $end, array $listIdVehicle , array $relations ): array;

    public function getTicketProductionByDateOfFleetWithRelations( string $start , string $end, array $fleetVehicle , array $relations ): array;

    public function save(Ticket $ticket): void;

    public function getTicketProductionRanckingOfFleetByDateWithRelations( string $start , string $end, array $fleetVehicle , array $relations ): array;

    public function getTicketProductionRanckingOfFleetByDateByTicketTypeWithRelations(string $start , string $end, array $fleetVehicle , array $relations ): array;

    function getTurnActualByIdVehicle( TicketIdVehicle $ticketIdVehicle ): ?int;

    public function getTicketsCollectionByDateByVehicleByTurnWithRelations( string $date, TicketIdVehicle $ticketIdVehicle, TicketTurn $ticketTurn, array $relations): array;

    // Version 1
    public function registrarBoletoPorPlaca(
        Id $idBoleto,
        Id $idVehiculo,
        Id $idRuta,
        Numeric $latitud,
        Numeric $longitud,
        DateTimeFormat $fecha,
        Numeric $monto,
        Text $numeroBoleto,
        Text $dni,
        DateOnlyFormat $reserved
    ): void;

    // Liquidacion Administrativa
    public function liquidacionDiariaBus(DateOnlyFormat $fecha, Id $idCliente, Id $idVehiculo): array;
}
