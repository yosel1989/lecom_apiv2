<?php
declare(strict_types=1);

namespace Src\V2\CajaTraslado\Domain;

final class CajaTrasladoGroupTipoFechaShortList
{
    /**
     * @var CajaTrasladoGroupTipoFechaShort[] The collection
     */
    private array $list;

    /**
     * The constructor.
     *
     * @param CajaTrasladoGroupTipoFechaShort ...$collection The collection
     */
    public function __construct(CajaTrasladoGroupTipoFechaShort ...$collection)
    {
        $this->list = $collection;
    }

    /**
     * Add model to list.
     *
     * @param CajaTrasladoGroupTipoFechaShort $model The model
     *
     * @return void
     */
    public function add(CajaTrasladoGroupTipoFechaShort $model): void
    {
        $this->list[] = $model;
    }

    /**
     * Get all collection.
     *
     * @return CajaTrasladoGroupTipoFechaShort[] The collection
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

