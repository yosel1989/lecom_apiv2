<?php
declare(strict_types=1);

namespace Src\V2\MedioPago\Domain;

final class MedioPagoList
{
    /**
     * @var MedioPago[] The collection
     */
    private array $list;

    /**
     * The constructor.
     *
     * @param MedioPago ...$collection The collection
     */
    public function __construct(MedioPago ...$collection)
    {
        $this->list = $collection;
    }

    /**
     * Add model to list.
     *
     * @param MedioPago $model The model
     *
     * @return void
     */
    public function add(MedioPago $model): void
    {
        $this->list[] = $model;
    }

    /**
     * Get all collection.
     *
     * @return MedioPago[] The collection
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

