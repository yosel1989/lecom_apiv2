<?php
declare(strict_types=1);

namespace Src\V2\LiquidacionEstadoMotivo\Domain;

final class LiquidacionEstadoMotivoList
{
    /**
     * @var LiquidacionEstadoMotivo[] The collection
     */
    private array $list;

    /**
     * The constructor.
     *
     * @param LiquidacionEstadoMotivo ...$collection The collection
     */
    public function __construct(LiquidacionEstadoMotivo ...$collection)
    {
        $this->list = $collection;
    }

    /**
     * Add model to list.
     *
     * @param LiquidacionEstadoMotivo $model The model
     *
     * @return void
     */
    public function add(LiquidacionEstadoMotivo $model): void
    {
        $this->list[] = $model;
    }

    /**
     * Get all collection.
     *
     * @return LiquidacionEstadoMotivo[] The collection
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

