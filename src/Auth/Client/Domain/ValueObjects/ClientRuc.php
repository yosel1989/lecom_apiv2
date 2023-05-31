<?php

declare(strict_types=1);

namespace Src\Auth\Client\Domain\ValueObjects;


use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;

final class ClientRuc
{
    /**
     * @var string
     */
    private $ruc;

    public function __construct(string $ruc )
    {
        $this->validate( $ruc );
        $this->ruc = $ruc;
    }

    /**
     * @param string $ruc
     */
    private function validate(string $ruc): void
    {
        if( strlen( $ruc ) > 15 ){
            throw new InvalidArgumentException('Ruc cannot exceeding 15 characters');
        }
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->ruc;
    }
}
