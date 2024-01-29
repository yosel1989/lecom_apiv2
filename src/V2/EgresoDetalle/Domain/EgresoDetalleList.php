<?php
declare(strict_types=1);

namespace Src\V2\EgresoDetalle\Domain;

final class EgresoDetalleList
{
    /**
     * @var EgresoDetalle[] The collection
     */
    private array $list;

    /**
     * The constructor.
     *
     * @param EgresoDetalle ...$collection The collection
     */
    public function __construct(EgresoDetalle ...$collection)
    {
        $this->list = $collection;
    }

    /**
     * Add model to list.
     *
     * @param EgresoDetalle $model The model
     *
     * @return void
     */
    public function add(EgresoDetalle $model): void
    {
        $this->list[] = $model;
    }

    /**
     * Get all collection.
     *
     * @return EgresoDetalle[] The collection
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

