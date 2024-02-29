<?php
declare(strict_types=1);

namespace Src\V2\MedioPago\Domain;

final class MedioPagoShortList
{
    /**
     * @var MedioPagoShort[] The collection
     */
    private array $list;

    /**
     * The constructor.
     *
     * @param MedioPagoShort ...$collection The collection
     */
    public function __construct(MedioPagoShort ...$collection)
    {
        $this->list = $collection;
    }

    /**
     * Add model to list.
     *
     * @param MedioPagoShort $model The model
     *
     * @return void
     */
    public function add(MedioPagoShort $model): void
    {
        $this->list[] = $model;
    }

    /**
     * Get all collection.
     *
     * @return MedioPagoShort[] The collection
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

