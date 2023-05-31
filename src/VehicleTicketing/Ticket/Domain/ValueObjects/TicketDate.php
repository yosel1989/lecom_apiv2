<?php

declare(strict_types=1);

namespace Src\VehicleTicketing\Ticket\Domain\ValueObjects;

use DateTime;
use InvalidArgumentException;

final class TicketDate
{
    /**
     * @var string
     */
    private $date;

    public function __construct( string $date )
    {
        $this->validate( $date );
        $this->date = $date;
    }

    /**
     * @param string $date
     */
    private function validate(string $date): void
    {
        $format = 'Y-m-d H:i:s';
        $d = DateTime::createFromFormat($format, $date);
        $result = $d && $d->format($format) == $date;
        if( !$result ){
            throw new InvalidArgumentException('Incorrect format date Y-m-d H:i:s ' . $date);
        }
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->date;
    }
}
