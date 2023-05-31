<?php

declare(strict_types=1);

namespace Src\VehicleTicketing\Ticket\Domain\ValueObjects;


use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

final class TicketIdMachine
{
    /**
     * @var string
     */
    private $idMachine;

    public function __construct( string $idMachine )
    {
        $this->validate( $idMachine );
        $this->idMachine = $idMachine;
    }

    /**
     * @param string $idMachine
     */
    private function validate( string $idMachine ): void
    {
        if ( !is_null($idMachine) ){
            if( !Uuid::isValid($idMachine) ){
                throw new InvalidArgumentException( 'Does not allow the invalid format id ticket machine');
            }
        }
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->idMachine;
    }
}
