<?php

declare(strict_types=1);

namespace Src\Core\Domain\ValueObjects;

use DateTime;
use InvalidArgumentException;

final class TimeFormat
{
    private string | null $value;
    private bool $nullable;
    private string $messageError;

    /**
     * ClientDeleted constructor.
     * @param string|null $value
     * @param bool $nullable
     * @param string $messageError
     */
    public function __construct(string | null $value, bool $nullable = false, string $messageError = "" )
    {
        $this->nullable = $nullable;
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
        $now = new DateTime('now');

        if($this->nullable){
            if(!is_null($value)){
                $format = 'Y-m-d H:i:s';
                $d = DateTime::createFromFormat($format, $now->format('Y-m-d ').$value);
                $result = $d && $d->format($format) == $now->format('Y-m-d ').$value;
                if( !$result ){
                    throw new InvalidArgumentException($this->messageError . $value);
                }
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

