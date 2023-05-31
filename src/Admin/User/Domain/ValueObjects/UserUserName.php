<?php

declare(strict_types=1);

namespace Src\Admin\User\Domain\ValueObjects;


use InvalidArgumentException;

final class UserUserName
{
    /**
     * @var string
     */
    private $username;

    public function __construct(string $username )
    {
        $this->validate( $username );
        $this->username = $username;
    }

    /**
     * @param string $username
     */
    private function validate(string $username): void
    {
        if( strlen( $username ) > 20 ){
            throw new InvalidArgumentException('Phone cannot exceeding 15 characters');
        }
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->username;
    }
}
