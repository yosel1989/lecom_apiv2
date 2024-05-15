<?php
declare(strict_types=1);

namespace Src\V2\CajaTraslado\Domain;

final class CajaTrasladoList
{
    /**
     * @var CajaTraslado[] The collection
     */
    private array $list;

    /**
     * The constructor.
     *
     * @param CajaTraslado ...$collection The collection
     */
    public function __construct(CajaTraslado ...$collection)
    {
        $this->list = $collection;
    }

    /**
     * Add model to list.
     *
     * @param CajaTraslado $model The model
     *
     * @return void
     */
    public function add(CajaTraslado $model): void
    {
        $this->list[] = $model;
    }

    /**
     * Get all collection.
     *
     * @return CajaTraslado[] The collection
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

