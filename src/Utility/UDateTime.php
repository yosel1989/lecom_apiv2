<?php

declare(strict_types=1);

namespace Src\Utility;

use DateTime;
use InvalidArgumentException;

final class UDateTime
{
    /**
     * @var string
     */
    private $value;

    public function __construct( string $value )
    {
        $this->valivalue( $value );
        $this->value = $value;
    }

    /**
     * @param string $value
     */
    private function valivalue(string $value): void
    {
        $format = 'Y-m-d H:i:s';
        $d = DateTime::createFromFormat($format, $value);
        $result = $d && $d->format($format) == $value;
        if( !$result ){
            throw new InvalidArgumentException('Incorrect format value Y-m-d H:i:s ' . $value);
        }
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }
}
