<?php

declare(strict_types=1);

namespace Src\Admin\Client\Domain\ValueObjects;

use InvalidArgumentException;

final class ClientAddress
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
        if( strlen( $value ) > 100 ){
            throw new InvalidArgumentException('Client Address cannot exceeding 100 characters');
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
