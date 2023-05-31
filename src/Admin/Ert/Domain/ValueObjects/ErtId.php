<?php

declare(strict_types=1);

namespace Src\Admin\Ert\Domain\ValueObjects;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

final class ErtId
{
    /**
     * @var string
     */
    private $value;

    /**
     * EmployeeId constructor.
     * @param string $value
     */
    public function __construct(string $value )
    {
        $this->validation($value);
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function value() : string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    private function validation( string $value ): void
    {
        if( !Uuid::isValid($value) ){
            throw new InvalidArgumentException( 'Incorrect format  Ert id ' . $value );
        }
    }

}
