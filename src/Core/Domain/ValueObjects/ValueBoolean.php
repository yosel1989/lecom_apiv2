<?php

declare(strict_types=1);

namespace Src\Core\Domain\ValueObjects;

final class ValueBoolean
{
    private bool $value;
//    private string $messageError;

    /**
     * @param bool $value
     */
    public function __construct(bool $value)
    {
//        $this->messageError = $messageError;
        $this->value = $value;
    }

    /**
     * @return bool
     */
    public function value() : bool
    {
        return $this->value;
    }

    /**
     * @param bool $value
     */
    private function validation( bool $value ): void
    {

//        if($this->nullable){
//            if(!is_null($value)){
//                if($this->length < 0){
//                    return;
//                }
//                if( strlen( $value ) > $this->length  ){
//                    throw new InvalidArgumentException( $this->messageError . $value );
//                }
//            }
//        }else{
//            if($this->length < 0){
//                return;
//            }
//            if( strlen( $value ) > $this->length  ){
//                throw new InvalidArgumentException( $this->messageError . $value );
//            }
//        }

    }
}
