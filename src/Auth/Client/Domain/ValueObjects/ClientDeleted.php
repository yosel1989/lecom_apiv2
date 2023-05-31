<?php

declare(strict_types=1);

namespace Src\Auth\Client\Domain\ValueObjects;


use InvalidArgumentException;

final class ClientDeleted
{
    /**
     * @var int
     */
    private $deleted;

    public function __construct( int $deleted )
    {
        $this->validate( $deleted );
        $this->deleted = $deleted;
    }

    /**
     * @param int $deleted
     */
    private function validate( int $deleted ): void
    {
        if( !($deleted === 0 || $deleted ===1) ){
            throw new InvalidArgumentException( 'Deleted only value 0 or 1 ' );
        }
    }

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->deleted;
    }
}
