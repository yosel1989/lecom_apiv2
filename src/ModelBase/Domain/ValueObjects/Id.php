<?php

declare(strict_types=1);

namespace Src\ModelBase\Domain\ValueObjects;
use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

final class Id
{
    private $value;
    private $nullable;
    private $messageError;

    public function __construct( ?string $value , bool $nullable = false, string $messageError = '' )
    {
        $this->nullable = $nullable;
        $this->messageError = $messageError;
        $this->validation($value);
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function value() : ?string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    private function validation( ?string $value ): void
    {
        if($this->nullable){
            if(is_null($value)){  return; }
            if( !Uuid::isValid($value) ){
                throw new InvalidArgumentException( $this->messageError . ' : '.$value );
            }
        }else{
            if( !Uuid::isValid($value) ){
                throw new InvalidArgumentException( $this->messageError . ' : '.$value );
            }
        }
    }
}
