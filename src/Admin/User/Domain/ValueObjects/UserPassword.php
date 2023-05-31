<?php

declare(strict_types=1);

namespace Src\Admin\User\Domain\ValueObjects;


use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;

final class UserPassword
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
            throw new InvalidArgumentException('Password cannot exceeding 15 characters');
        }
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return Hash::make($this->value);
    }
}
