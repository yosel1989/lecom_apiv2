<?php
declare(strict_types=1);

namespace Src\V2\Egreso\Domain;

final class EgresoList
{
    /**
     * @var Egreso[] The collection
     */
    private array $list;

    /**
     * The constructor.
     *
     * @param Egreso ...$collection The collection
     */
    public function __construct(Egreso ...$collection)
    {
        $this->list = $collection;
    }

    /**
     * Add model to list.
     *
     * @param Egreso $model The model
     *
     * @return void
     */
    public function add(Egreso $model): void
    {
        $this->list[] = $model;
    }

    /**
     * Get all collection.
     *
     * @return Egreso[] The collection
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

