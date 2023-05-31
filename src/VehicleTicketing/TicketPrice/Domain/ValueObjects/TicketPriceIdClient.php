<?php

declare(strict_types=1);

namespace Src\VehicleTicketing\TicketPrice\Domain\ValueObjects;


use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

final class TicketPriceIdClient
{
    /**
     * @var string
     */
    private $idClient;

    public function __construct(string $idClient )
    {
        $this->validate( $idClient );
        $this->idClient = $idClient;
    }

    /**
     * @param string idClient
     */
    private function validate(string $idClient): void
    {
        if( !Uuid::isValid($idClient) ){
            throw new InvalidArgumentException( 'Does not allow the invalid format TicketPriceIdClient');
        }
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->idClient;
    }
}
