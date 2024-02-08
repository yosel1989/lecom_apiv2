<?php
declare(strict_types=1);

namespace Src\V2\Liquidacion\Domain;

final class LiquidacionList
{
    /**
     * @var Liquidacion[] The collection
     */
    private array $list;

    /**
     * The constructor.
     *
     * @param Liquidacion ...$collection The collection
     */
    public function __construct(Liquidacion ...$collection)
    {
        $this->list = $collection;
    }

    /**
     * Add model to list.
     *
     * @param Liquidacion $model The model
     *
     * @return void
     */
    public function add(Liquidacion $model): void
    {
        $this->list[] = $model;
    }

    /**
     * Get all collection.
     *
     * @return Liquidacion[] The collection
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

