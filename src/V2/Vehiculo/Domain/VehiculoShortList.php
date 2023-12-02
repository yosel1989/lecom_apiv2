<?php
declare(strict_types=1);

namespace Src\V2\Vehiculo\Domain;

final class VehiculoShortList
{
    /**
     * @var VehiculoShort[] The vehiculos
     */
    private array $list;

    /**
     * The constructor.
     *
     * @param VehiculoShort ...$vehiculo The vehiculos
     */
    public function __construct(VehiculoShort ...$vehiculo)
    {
        $this->list = $vehiculo;
    }

    /**
     * Add vehiculo to list.
     *
     * @param VehiculoShort $vehiculo The vehiculo
     *
     * @return void
     */
    public function add(VehiculoShort $vehiculo): void
    {
        $this->list[] = $vehiculo;
    }

    /**
     * Get all vehiculos.
     *
     * @return VehiculoShort[] The vehiculos
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

