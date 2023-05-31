<?php


namespace Src\VehicleTicketing\TicketMachine\Application;


use Src\VehicleTicketing\TicketMachine\Domain\Contracts\TicketMachineRepositoryContract;
use Src\VehicleTicketing\TicketMachine\Domain\TicketMachine;
use Src\VehicleTicketing\TicketMachine\Domain\ValueObjects\TicketMachineImei;


final class GetTicketMachineByImeiUseCase
{
    private $repository;

    public function __construct(TicketMachineRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $imei ): ?TicketMachine
    {
        $imei = new TicketMachineImei($imei);

        return $this->repository->findByImei( $imei );
    }
}
