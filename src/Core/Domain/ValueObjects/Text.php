<?php

declare(strict_types=1);

namespace Src\Core\Domain\ValueObjects;
use InvalidArgumentException;

final class Text
{
    private string | null $value;
    private bool $nullable;
    private int $length;
    private string $messageError;

    /**
     * @param string|null $value
     * @param bool $nullable
     * @param int $length
     * @param string $messageError
     */
    public function __construct(string | null $value , bool $nullable = false, int $length = 0, string $messageError = "" )
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
    public function value() : string | null
    {
        return $this->value;
    }

    /**
     * @param string|null $value
     */
    private function validation( string | null $value ): void
    {

        if($this->nullable){
            if(!is_null($value)){
                if( strlen( $value ) > $this->length  ){
                    throw new InvalidArgumentException( $this->messageError . $value );
                }
            }
        }else{
            if( strlen( $value ) > $this->length  ){
                throw new InvalidArgumentException( $this->messageError . $value );
            }
        }

    }
}
