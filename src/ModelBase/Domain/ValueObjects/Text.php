<?php

declare(strict_types=1);

namespace Src\ModelBase\Domain\ValueObjects;
use InvalidArgumentException;

final class Text
{
    private $value;
    private $nullable;
    private $length;
    private $messageError;

    /**
     * @param string|null $value
     * @param bool $nullable
     * @param int $length
     * @param string $messageError
     */
    public function __construct(?string $value , bool $nullable = false, int $length = 0, string $messageError = '' )
    {
        $this->nullable = $nullable;
        $this->length = $length;
        $this->messageError = $messageError;
        $this->validation($value);
        $this->value = $value;
    }

    /**
     * @return string|null
     */
    public function value() : ?string
    {
        return $this->value;
    }

    /**
     * @param string|null $value
     */
    private function validation( ?string $value ): void
    {
        if($this->nullable){
            if(is_null($value)){ return; }
            if( strlen( $value ) > $this->length  ){
                throw new InvalidArgumentException( $this->messageError . $value );
            }
        }else{
            if( strlen( $value ) > $this->length  ){
                throw new InvalidArgumentException( $this->messageError . $value );
            }
        }
    }
}
