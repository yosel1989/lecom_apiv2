<?php

declare(strict_types=1);

namespace Src\VehicleTicketing\Ticket\Domain\ValueObjects;


use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

final class TicketIdType
{
    /**
     * @var string
     */
    private $idType;

    public function __construct( string $idType )
    {
        $this->validate( $idType );
        $this->idType = $idType;
    }

    /**
     * @param string $idType
     */
    private function validate( string $idType ): void
    {
        if ( !is_null($idType) ){
            if( !Uuid::isValid($idType) ){
                throw new InvalidArgumentException( 'Does not allow the invalid format id ticket type');
            }
        }
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->idType;
    }
}
