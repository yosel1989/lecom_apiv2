<?php

declare(strict_types=1);

namespace Src\Admin\Client\Domain\ValueObjects;

use InvalidArgumentException;

final class ClientLastName
{
    /**
     * @var string
     */
    private $value;

    public function __construct(string $value )
    {
        $this->validate( $value );
        $this->value = $value;
    }

    /**
     * @param string $value
     */
    private function validate(string $value): void
    {
        if( strlen( $value ) > 50 ){
            throw new InvalidArgumentException('Client Last Name cannot exceeding 50 characters');
        }
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

}
