<?php

declare(strict_types=1);

namespace Src\Admin\Client\Domain\ValueObjects;


use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

final class ClientIdParent
{
    /**
     * @var string
     */
    private $value;

    public function __construct( ?string $value )
    {
        $this->validate( $value );
        $this->value = $value;
    }

    /**
     * @param string id
     */
    private function validate( ?string $value): void
    {
        if(is_null($value)){return;}
        if( !Uuid::isValid($value) ){
            throw new InvalidArgumentException( 'Does not allow the invalid format Client Parent id ' . $value);
        }
    }

    /**
     * @return string
     */
    public function value(): ?string
    {
        return $this->value;
    }
}
