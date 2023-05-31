<?php

declare(strict_types=1);

namespace Src\Admin\Module\Domain\ValueObjects;


use InvalidArgumentException;

final class ModuleShortName
{
    /**
     * @var string
     */
    private $value;

    /**
     * ModuleId constructor.
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
        if( strlen( $value ) > 7 ){
            throw new InvalidArgumentException( 'Max Length module short name 7 characters' . $value );
        }
    }

}
