<?php
declare(strict_types=1);

namespace Src\Admin\Vehicle\Domain\ValueObjects;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

final class VehicleIdBrand
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
                throw new InvalidArgumentException( 'Incorrect format vehicle id brand' . $value );
            }
        }
    }
}
