<?php

declare(strict_types=1);

namespace Src\Auth\User\Domain\ValueObjects;


use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;

final class UserPassword
{
    /**
     * @var string
     */
    private $password;

    public function __construct(string $password )
    {
        $this->validate( $password );
        $this->password = $password;
    }

    /**
     * @param string $password
     */
    private function validate(string $password): void
    {

    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->password;
    }
}
