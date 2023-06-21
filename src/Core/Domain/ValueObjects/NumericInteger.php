<?php

declare(strict_types=1);

namespace Src\Core\Domain\ValueObjects;

final class NumericInteger
{
      private ?int  $value;
//    private bool $nullable;
//    private string $messageError;

    /**
     * @param int|null $value
     */
    public function __construct(?int $value)
    {
//        $this->nullable = $nullable;
//        $this->messageError = $messageError;
//        $this->validation($value);
        $this->value = $value;
    }

    /**
     * @return int|null
     */
    public function value() : ?int
    {
        return $this->value;
    }

//    /**
//     * @param int|int|null $value
//     */
//    private function validation( int | int | null $value ): void
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
