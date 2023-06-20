<?php
declare(strict_types=1);

namespace Src\TransporteInterprovincial\Destino\Domain\ValueObjects;

use InvalidArgumentException;

final class DestinoUnit
{
    /**
     * @var string
     */
    private $unit;

    /**
     * EmployeeEmail constructor.
     * @param string $unit
     */
    public function __construct(string $unit )
    {
        $this->validation($unit);
        $this->unit = $unit;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->unit;
    }

    /**
     * @param string $unit
     */
    public function validation(string $unit): void
    {
        if( strlen( $unit ) > 10 ){
            throw new InvalidArgumentException('Max Length Destino unit 10 characters');
        }
    }
}
