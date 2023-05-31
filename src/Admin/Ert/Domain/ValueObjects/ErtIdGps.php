<?php
declare(strict_types=1);

namespace Src\Admin\Ert\Domain\ValueObjects;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

final class ErtIdGps
{
    /**
     * @var string
     */
    private $value;

    /**
     * EmployeeIdClient constructor.
     * @param string $value
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
     * @param string $value
     */
    public function validate( ?string $value): void
    {
        if(!is_null($value)){
            if( !Uuid::isValid($value) ){
                throw new InvalidArgumentException( 'Incorrect format Ert id gps' . $value );
            }
        }

    }
}
