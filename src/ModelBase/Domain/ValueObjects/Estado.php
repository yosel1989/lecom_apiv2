<?php

declare(strict_types=1);

namespace Src\ModelBase\Domain\ValueObjects;

final class Estado
{
    private $value;


    public function __construct( bool $value )
    {
        $this->value = $value;
    }

    /**
     * @return bool
     */
    public function value() : bool
    {
        return $this->value;
    }

    /**
     * @param bool $value
     */
    private function validation( bool $value ): void
    {

    }
}
