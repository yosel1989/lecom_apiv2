<?php

declare(strict_types=1);

namespace Src\VehicleTicketing\TicketMachine\Domain\ValueObjects;


use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

final class TicketMachineIdVehicle
{
    /**
     * @var string
     */
    private $idVehicle;

    public function __construct(string $idVehicle )
    {
        $this->validate( $idVehicle );
        $this->idVehicle = $idVehicle;
    }

    /**
     * @param string idVehicle
     */
    private function validate(string $idVehicle): void
    {
        if( !Uuid::isValid($idVehicle) ){
            throw new InvalidArgumentException( 'Does not allow the invalid format id vehicle');
        }
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->idVehicle;
    }
}
