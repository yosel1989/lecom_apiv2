<?php

declare(strict_types=1);

namespace Src\VehicleTicketing\Ticket\Domain\ValueObjects;


use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

final class TicketIdPrice
{
    /**
     * @var string
     */
    private $idPrice;

    public function __construct( string $idPrice )
    {
        $this->validate( $idPrice );
        $this->idPrice = $idPrice;
    }

    /**
     * @param string $idPrice
     */
    private function validate( string $idPrice ): void
    {
        if ( !is_null($idPrice) ){
            if( !Uuid::isValid($idPrice) ){
                throw new InvalidArgumentException( 'Does not allow the invalid format id ticket price');
            }
        }
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->idPrice;
    }
}
