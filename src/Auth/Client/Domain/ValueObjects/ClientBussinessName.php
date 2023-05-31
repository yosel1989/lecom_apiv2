<?php

declare(strict_types=1);

namespace Src\Auth\Client\Domain\ValueObjects;

use InvalidArgumentException;

final class ClientBussinessName
{
    /**
     * @var string
     */
    private $bussinessName;

    public function __construct(string $bussinessName )
    {
        $this->validate( $bussinessName );
        $this->bussinessName = $bussinessName;
    }

    /**
     * @param string $bussinessName
     */
    private function validate(string $bussinessName): void
    {
        if( strlen( $bussinessName ) > 50 ){
            throw new InvalidArgumentException('Bussiness name cannot exceeding 50 characters');
        }
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->bussinessName;
    }
}
