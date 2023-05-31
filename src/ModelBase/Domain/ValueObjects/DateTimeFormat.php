<?php

declare(strict_types=1);

namespace Src\ModelBase\Domain\ValueObjects;

use DateTime;
use InvalidArgumentException;

final class DateTimeFormat
{
    private $value;
    private $nullable;
    private $messageError;

    /**
     * ClientDeleted constructor.
     * @param string|null $value
     */
    public function __construct(?string $value, bool $nullable = false, string $messageError = '' )
    {
        $this->nullable = $nullable;
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
            $format = 'Y-m-d H:i:s';
            $d = DateTime::createFromFormat($format, $value);
            $result = $d && $d->format($format) == $value;
            if( !$result ){
                throw new InvalidArgumentException($this->messageError . $value);
            }
        }else{

            $format = 'Y-m-d H:i:s';
            $d = DateTime::createFromFormat($format, $value);
            $result = $d && $d->format($format) == $value;
            if( !$result ){
                throw new InvalidArgumentException($this->messageError . $value);
            }
        }
    }
}
