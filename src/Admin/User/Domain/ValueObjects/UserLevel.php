<?php

declare(strict_types=1);

namespace Src\Admin\User\Domain\ValueObjects;

use InvalidArgumentException;

final class UserLevel
{
    /**
     * @var int
     */
    private $level;

    public function __construct(int $level )
    {
        $this->validate( $level );
        $this->level = $level;
    }

    /**
     * @param int $level
     */
    private function validate(int $level): void
    {
        if( !($level >= 0 && $level <= 3) ){
            throw new InvalidArgumentException( 'User level accept value between 0 and 3');
        }
    }

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->level;
    }
}
