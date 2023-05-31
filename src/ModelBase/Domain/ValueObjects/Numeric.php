<?php

declare(strict_types=1);

namespace Src\ModelBase\Domain\ValueObjects;
use InvalidArgumentException;

final class Numeric
{
    private $value;
    private $nullable;
    private $messageError;

    /**
     * @param $value
     * @param bool $nullable
     * @param string $messageError
     */
    public function __construct( $value , bool $nullable = false, string $messageError = '' )
    {
        $this->nullable = $nullable;
        $this->messageError = $messageError;
        $this->validation($value);
        $this->value = $value;
    }

    public function value()
    {
        return $this->value;
    }

    private function validation( $value ): void
    {
    }
}
