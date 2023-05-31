<?php

declare(strict_types=1);

namespace Src\ModelBase\Domain\ValueObjects;

use InvalidArgumentException;

final class DateOnlyFormat
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
            $datetime = strtotime($value);
            if (!$datetime) {
                throw new InvalidArgumentException($this->messageError . $value);
            }
        }else{
            $datetime = strtotime($value);
            if (!$datetime) {
                throw new InvalidArgumentException($this->messageError . $value);
            }
        }
    }
}
