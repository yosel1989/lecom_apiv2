<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachineHistory\Domain\ValueObjects;


final class CMHLevelOutput
{
    /**
     * @var float|null
     */
    private $value;

    /**
     * ColdMachineHistoryId constructor.
     * @param float|null $value
     */
    public function __construct( ?float $value )
    {
//        $this->validate($value);
        $this->value = $value;
    }

    public function value(): ?float{
        return $this->value;
    }

    /**
     * @param float|null $value
     */
    private function validate( ?float $value ): void
    {
    }

}
