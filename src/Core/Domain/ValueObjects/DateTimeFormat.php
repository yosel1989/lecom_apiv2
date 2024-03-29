<?php

declare(strict_types=1);

namespace Src\Core\Domain\ValueObjects;

use DateTime;
use InvalidArgumentException;

final class DateTimeFormat
{
    private ?string $value;
    private bool $nullable;
    private string $messageError;

    /**
     * ClientDeleted constructor.
     * @param string|null $value
     * @param bool $nullable
     * @param string $messageError
     */
    public function __construct(?string $value, bool $nullable = false, string $messageError = "" )
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

    public function date() : ?string
    {
        return (new \DateTime($this->value))->format('Y-m-d');
    }

    public function time() : ?string
    {
        return (new \DateTime($this->value))->format('H:m:s');
    }


    /**
     * @param string|null $value
     */
    private function validation( ?string $value ): void
    {
        if($this->nullable){
            if(!is_null($value)){
                $format = 'Y-m-d H:i:s';
                $d = DateTime::createFromFormat($format, $value);
                $result = $d && $d->format($format) == $value;
                if( !$result ){
                    throw new InvalidArgumentException($this->messageError . $value);
                }
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
