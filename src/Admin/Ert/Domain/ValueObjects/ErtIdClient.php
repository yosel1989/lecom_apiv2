<?php
declare(strict_types=1);

namespace Src\Admin\Ert\Domain\ValueObjects;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

final class ErtIdClient
{
    /**
     * @var string
     */
    private $value;

    /**
     * EmployeeIdClient constructor.
     * @param string $value
     */
    public function __construct(string $value )
    {
        $this->validate($value);
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function validate(string $value): void
    {
        if( !Uuid::isValid($value) ){
            throw new InvalidArgumentException( 'Incorrect format Ert id client' . $value );
        }
    }
}
