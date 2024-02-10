<?php
declare(strict_types=1);

namespace Src\V2\EgresoEstadoMotivo\Domain;

final class EgresoEstadoMotivoList
{
    /**
     * @var EgresoEstadoMotivo[] The collection
     */
    private array $list;

    /**
     * The constructor.
     *
     * @param EgresoEstadoMotivo ...$collection The collection
     */
    public function __construct(EgresoEstadoMotivo ...$collection)
    {
        $this->list = $collection;
    }

    /**
     * Add model to list.
     *
     * @param EgresoEstadoMotivo $model The model
     *
     * @return void
     */
    public function add(EgresoEstadoMotivo $model): void
    {
        $this->list[] = $model;
    }

    /**
     * Get all collection.
     *
     * @return EgresoEstadoMotivo[] The collection
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

