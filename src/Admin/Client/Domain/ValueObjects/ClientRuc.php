<?php

declare(strict_types=1);

namespace Src\Admin\Client\Domain\ValueObjects;

use InvalidArgumentException;

final class ClientRuc
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
        if( strlen( $value ) > 15 ){
            throw new InvalidArgumentException('Client Ruc cannot exceeding 15 characters');
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
