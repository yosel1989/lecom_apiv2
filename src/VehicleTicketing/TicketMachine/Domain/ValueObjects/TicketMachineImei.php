<?php

declare(strict_types=1);

namespace Src\VehicleTicketing\TicketMachine\Domain\ValueObjects;

final class TicketMachineImei
{
    /**
     * @var string
     */
    private $imei;

    public function __construct(string $imei )
    {
        $this->valimeiate( $imei );
        $this->imei = $imei;
    }

    /**
     * @param string imei
     */
    private function valimeiate(string $imei): void
    {

    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->imei;
    }
}
