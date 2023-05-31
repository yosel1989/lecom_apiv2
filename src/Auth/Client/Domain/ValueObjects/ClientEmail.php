<?php

declare(strict_types=1);

namespace Src\Auth\Client\Domain\ValueObjects;

use InvalidArgumentException;

final class ClientEmail
{
    /**
     * @var string
     */
    private $email;

    public function __construct(string $email )
    {
        $this->validate( $email );
        $this->email = $email;
    }

    /**
     * @param string $email
     */
    private function validate(string $email): void
    {
        if( $email !== ""){
            if( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ){
                throw new InvalidArgumentException( 'Does not allow the invalid email '.$email);
            }

            if( strlen( $email ) > 50 ){
                throw new InvalidArgumentException('Email cannot exceeding 50 characters');
            }
        }
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->email;
    }

}
