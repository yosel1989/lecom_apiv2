<?php

declare(strict_types=1);

namespace Src\ModelBase\Domain\ValueObjects;

use DateTime;
use InvalidArgumentException;

final class TimeFormat
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
        $now = new \DateTime('now');
        if($this->nullable){
            if(is_null($value)){ return; }
            $format = 'Y-m-d H:i:s';
            $d = DateTime::createFromFormat($format, $now->format('Y-m-d ').$value);
            $result = $d && $d->format($format) == $now->format('Y-m-d ').$value;
            if( !$result ){
                throw new InvalidArgumentException($this->messageError . $value);
            }
        }else{

            $format = 'Y-m-d H:i:s';
            $d = DateTime::createFromFormat($format, $now->format('Y-m-d ').$value);
            $result = $d && $d->format($format) == $now->format('Y-m-d ').$value;
            if( !$result ){
                throw new InvalidArgumentException($this->messageError . $value);
            }
        }
    }
}
