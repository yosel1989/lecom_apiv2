<?php

declare(strict_types=1);

namespace Src\Admin\GpsModel\Domain\ValueObjects;


use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

final class GpsModelId
{
    /**
     * @var string
     */
    private $value;

    /**
     * GpsModelId constructor.
     * @param string $value
     */
    public function __construct( string $value )
    {
        $this->validate($value);
        $this->value = $value;
    }

    public function value(): string{
        return $this->value;
    }

    /**
     * @param string $value
     */
    private function validate( string $value ): void
    {
        if( !Uuid::isValid($value) ){
            throw new InvalidArgumentException( 'Incorrect format gps model id ' . $value );
        }
    }

}
