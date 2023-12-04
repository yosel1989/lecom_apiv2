<?php
declare(strict_types=1);

namespace Src\V2\LogBoletoInterprovincial\Domain;

final class LogBoletoInterprovincialList
{
    /**
     * @var LogBoletoInterprovincial[] The vehiculos
     */
    private array $list;

    /**
     * The constructor.
     *
     * @param LogBoletoInterprovincial ...$log The vehiculos
     */
    public function __construct(LogBoletoInterprovincial ...$log)
    {
        $this->list = $log;
    }

    /**
     * Add vehiculo to list.
     *
     * @param LogBoletoInterprovincial $log The vehiculo
     *
     * @return void
     */
    public function add(LogBoletoInterprovincial $log): void
    {
        $this->list[] = $log;
    }

    /**
     * Get all vehiculos.
     *
     * @return LogBoletoInterprovincial[] The vehiculos
     */
    public function all(): array
    {
        return $this->list;
    }


    /**
     * Get count vehiculos.
     *
     * @return int The vehiculos
     */
    public function count(): int
    {
        return count($this->list);
    }
}
