<?php

declare(strict_types=1);

namespace Src\Core\Domain\ValueObjects;

use InvalidArgumentException;

final class DateFormat
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

        if($this->nullable){
            if(!is_null($value)){
                $datetime = strtotime($value);
                if (!$datetime) {
                    throw new InvalidArgumentException($this->messageError . $value);
                }
            }
        }else{
            $datetime = strtotime($value);
            if (!$datetime) {
                throw new InvalidArgumentException($this->messageError . $value);
            }
        }

    }
}
