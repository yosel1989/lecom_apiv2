<?php

declare(strict_types=1);

namespace Src\Admin\TypePay\Domain\ValueObjects;

use InvalidArgumentException;

final class TypePayAmount
{
    /**
     * @var float
     */
    private $value;

    /**
     * TypePayId constructor.
     * @param float $value
     */
    public function __construct( float $value )
    {
        $this->value = $value;
    }

    public function value(): float{
        return $this->value;
    }

    /**
     * @param float $value
     */
    private function validate( float $value ): void
    {
    }

}
