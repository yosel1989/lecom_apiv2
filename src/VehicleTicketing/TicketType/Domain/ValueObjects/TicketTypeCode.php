<?php

declare(strict_types=1);

namespace Src\VehicleTicketing\TicketType\Domain\ValueObjects;

use InvalidArgumentException;

final class TicketTypeCode
{

    /**
     * @var int
     */
    private $code;

    public function __construct( int $code)
    {
        $this->validate( $code);
        $this->code = $code;
    }

    /**
     * @param int $code
     */
    private function validate( int $code): void
    {

    }

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->code;
    }

}
