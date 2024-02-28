<?php
declare(strict_types=1);

namespace Src\V2\Ingreso\Domain;

final class IngresoList
{
    /**
     * @var Ingreso[] The collection
     */
    private array $list;

    /**
     * The constructor.
     *
     * @param Ingreso ...$collection The collection
     */
    public function __construct(Ingreso ...$collection)
    {
        $this->list = $collection;
    }

    /**
     * Add model to list.
     *
     * @param Ingreso $model The model
     *
     * @return void
     */
    public function add(Ingreso $model): void
    {
        $this->list[] = $model;
    }

    /**
     * Get all collection.
     *
     * @return Ingreso[] The collection
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

