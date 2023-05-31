<?php


namespace Src\VehicleTicketing\TicketMachine\Domain\Contracts;



use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\VehicleTicketing\TicketMachine\Domain\TicketMachine;
use Src\VehicleTicketing\TicketMachine\Domain\ValueObjects\TicketMachineId;
use Src\VehicleTicketing\TicketMachine\Domain\ValueObjects\TicketMachineImei;

interface TicketMachineRepositoryContract
{
    public function find(TicketMachineId $id): ?TicketMachine;

    public function create( Id $id, Text $imei, Id $idClient, Id $idVehicle, Id $idUserCreated ): void;
    public function update(Id $id, Text $imei, Id $idClient, Id $idVehicle, Id $idUserUpdated): void;
    public function collectionByClient(Id $idClient): array;

    public function findByImei( TicketMachineImei $imei ): ?TicketMachine;

}
