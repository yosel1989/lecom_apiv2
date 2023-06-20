<?php
declare(strict_types=1);

namespace Src\TransporteInterprovincial\Destino\Domain\ValueObjects;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

final class DestinoIdBrand
{
    /**
     * @var string
     */
    private $value;

    /**
     * EmployeeIdClient constructor.
     * @param string|null $value
     */
    public function __construct( ?string $value )
    {
        $this->validate($value);
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function value(): ?string
    {
        return $this->value;
    }

    /**
     * @param string|null $value
     */
    public function validate( string $value = null ): void
    {
        if ( !(is_null($value)) ){
            if( !Uuid::isValid($value) ){
                throw new InvalidArgumentException( 'Incorrect format Destino id brand' . $value );
            }
        }
    }
}
