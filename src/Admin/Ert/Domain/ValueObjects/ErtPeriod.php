<?php

declare(strict_types=1);

namespace Src\Admin\Ert\Domain\ValueObjects;

use InvalidArgumentException;

final class ErtPeriod
{
    /**
     * @var int
     */
    private $value;

    public function __construct( int $value )
    {
        $this->validate( $value );
        $this->value = $value;
    }

    /**
     * @param int $value
     */
    private function validate( int $value ): void
    {
    }

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->value;
    }
}
