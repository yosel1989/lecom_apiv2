<?php

declare(strict_types=1);

namespace Src\VehicleTicketing\Ticket\Domain\ValueObjects;

use InvalidArgumentException;

final class TicketCode
{
    /**
     * @var string
     */
    private $code;

    public function __construct(string $code )
    {
        $this->validate( $code );
        $this->code = $code;
    }

    /**
     * @param string $code
     */
    private function validate(string $code): void
    {
        if( strlen( $code ) > 25 ){
            throw new InvalidArgumentException('Code ticket cannot exceeding 25 characters');
        }
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->code;
    }

}
