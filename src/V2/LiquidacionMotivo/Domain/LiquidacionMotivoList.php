<?php
declare(strict_types=1);

namespace Src\V2\LiquidacionMotivo\Domain;

final class LiquidacionMotivoList
{
    /**
     * @var LiquidacionMotivo[] The collection
     */
    private array $list;

    /**
     * The constructor.
     *
     * @param LiquidacionMotivo ...$collection The collection
     */
    public function __construct(LiquidacionMotivo ...$collection)
    {
        $this->list = $collection;
    }

    /**
     * Add model to list.
     *
     * @param LiquidacionMotivo $model The model
     *
     * @return void
     */
    public function add(LiquidacionMotivo $model): void
    {
        $this->list[] = $model;
    }

    /**
     * Get all collection.
     *
     * @return LiquidacionMotivo[] The collection
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

