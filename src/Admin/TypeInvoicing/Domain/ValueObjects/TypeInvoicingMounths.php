<?php

declare(strict_types=1);

namespace Src\Admin\TypeInvoicing\Domain\ValueObjects;


use InvalidArgumentException;

final class TypeInvoicingMounths
{
    /**
     * @var int
     */
    private $value;

    /**
     * TypeInvoicingId constructor.
     * @param int $value
     */
    public function __construct( int $value )
    {
        $this->value = $value;
    }

    public function value(): int{
        return $this->value;
    }

    /**
     * @param int $value
     */
    private function validate( int $value ): void
    {
    }

}
