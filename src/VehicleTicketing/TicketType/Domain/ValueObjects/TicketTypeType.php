<?php

declare(strict_types=1);

namespace Src\VehicleTicketing\TicketType\Domain\ValueObjects;


use InvalidArgumentException;

final class TicketTypeType
{
    /**
     * @var string
     */
    private $type;

    public function __construct(string $type )
    {
        $this->validate( $type );
        $this->type = $type;
    }

    /**
     * @param string $type
     */
    private function validate(string $type): void
    {
        if( strlen( $type ) > 25 ){
            throw new InvalidArgumentException('Name ticket type cannot exceeding 25 characters');
        }
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->type;
    }
}
