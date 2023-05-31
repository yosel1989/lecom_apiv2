<?php

declare(strict_types=1);

namespace Src\Auth\Client\Domain\ValueObjects;


use InvalidArgumentException;

final class ClientType
{
    /**
     * @var int
     */
    private $type;

    public function __construct( int $type )
    {
        $this->validate( $type );
        $this->type = $type;
    }

    /**
     * @param int $type
     */
    private function validate( int $type ): void
    {
        if( !($type === 0 || $type ===1) ){
            throw new InvalidArgumentException( 'Type client accept only value 0 or 1 ' );
        }
    }

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->type;
    }
}
