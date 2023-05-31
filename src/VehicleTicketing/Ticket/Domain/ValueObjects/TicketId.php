<?php

declare(strict_types=1);

namespace Src\VehicleTicketing\Ticket\Domain\ValueObjects;


use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

final class TicketId
{
    /**
     * @var string
     */
    private $id;

    public function __construct(string $id )
    {
        $this->validate( $id );
        $this->id = $id;
    }

    /**
     * @param string id
     */
    private function validate(string $id): void
    {
        if( !Uuid::isValid($id) ){
            throw new InvalidArgumentException( 'Does not allow the invalid format ticket id ' . $id);
        }
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->id;
    }
}
