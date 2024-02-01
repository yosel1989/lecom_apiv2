<?php
declare(strict_types=1);

namespace Src\V2\Egreso\Domain;

final class EgresoGroupTipoFechaShortList
{
    /**
     * @var EgresoGroupTipoFechaShort[] The collection
     */
    private array $list;

    /**
     * The constructor.
     *
     * @param EgresoGroupTipoFechaShort ...$collection The collection
     */
    public function __construct(EgresoGroupTipoFechaShort ...$collection)
    {
        $this->list = $collection;
    }

    /**
     * Add model to list.
     *
     * @param EgresoGroupTipoFechaShort $model The model
     *
     * @return void
     */
    public function add(EgresoGroupTipoFechaShort $model): void
    {
        $this->list[] = $model;
    }

    /**
     * Get all collection.
     *
     * @return EgresoGroupTipoFechaShort[] The collection
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

