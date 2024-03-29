<?php
declare(strict_types=1);

namespace Src\V2\Vehiculo\Domain;

final class VehiculoList
{
    /**
     * @var Vehiculo[] The vehiculos
     */
    private array $list;

    /**
     * The constructor.
     *
     * @param Vehiculo ...$vehiculo The vehiculos
     */
    public function __construct(Vehiculo ...$vehiculo)
    {
        $this->list = $vehiculo;
    }

    /**
     * Add vehiculo to list.
     *
     * @param Vehiculo $vehiculo The vehiculo
     *
     * @return void
     */
    public function add(Vehiculo $vehiculo): void
    {
        $this->list[] = $vehiculo;
    }

    /**
     * Get all vehiculos.
     *
     * @return Vehiculo[] The vehiculos
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

