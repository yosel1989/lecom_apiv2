<?php
declare(strict_types=1);

namespace Src\V2\CronogramaSalida\Domain;

final class CronogramaSalidaGroupTipoFechaShortList
{
    /**
     * @var CronogramaSalidaGroupTipoFechaShort[] The collection
     */
    private array $list;

    /**
     * The constructor.
     *
     * @param CronogramaSalidaGroupTipoFechaShort ...$collection The collection
     */
    public function __construct(CronogramaSalidaGroupTipoFechaShort ...$collection)
    {
        $this->list = $collection;
    }

    /**
     * Add model to list.
     *
     * @param CronogramaSalidaGroupTipoFechaShort $model The model
     *
     * @return void
     */
    public function add(CronogramaSalidaGroupTipoFechaShort $model): void
    {
        $this->list[] = $model;
    }

    /**
     * Get all collection.
     *
     * @return CronogramaSalidaGroupTipoFechaShort[] The collection
     */
    public function all(): array
    {
        return $this->list;
    }


    /**
     * Get count collection.
     *
     * @return int The collection
     */
    public function count(): int
    {
        return count($this->list);
    }
}

