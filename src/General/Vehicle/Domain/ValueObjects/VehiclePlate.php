<?php
declare(strict_types=1);

namespace Src\General\Vehicle\Domain\ValueObjects;

use InvalidArgumentException;

final class VehiclePlate
{
    /**
     * @var string
     */
    private $plate;

    /**
     * EmployeeEmail constructor.
     * @param string $plate
     */
    public function __construct(string $plate )
    {
        $this->validation($plate);
        $this->plate = $plate;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->plate;
    }

    /**
     * @param string $plate
     */
    public function validation(string $plate): void
    {
        if( strlen( $plate ) > 7 ){
            throw new InvalidArgumentException('Max Length vehicle plate 7 characters');
        }
    }
}
