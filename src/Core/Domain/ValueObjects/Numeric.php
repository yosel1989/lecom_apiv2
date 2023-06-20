<?php

declare(strict_types=1);

namespace Src\Core\Domain\ValueObjects;

final class Numeric
{
      private int | float  $value;
//    private bool $nullable;
//    private string $messageError;

    /**
     * @param int|float|null $value
     */
    public function __construct(?int $value)
    {
//        $this->nullable = $nullable;
//        $this->messageError = $messageError;
//        $this->validation($value);
        $this->value = $value;
    }

    /**
     * @return int | float | null
     */
    public function value() : int | float | null
    {
        return $this->value;
    }

//    /**
//     * @param int|float|null $value
//     */
//    private function validation( int | float | null $value ): void
//    {
//        if($this->nullable){
//            if(!is_null($value)){
//                if( !Uuid::isValid($value) ){
//                    throw new InvalidArgumentException( $this->messageError . ' : '. $value );
//                }
//            }
//        }else{
//            if( !Uuid::isValid($value) ){
//                throw new InvalidArgumentException( $this->messageError . ' : '.$value );
//            }
//        }
//    }
}
