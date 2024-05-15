<?php
declare(strict_types=1);

namespace Src\V2\ClienteMedioPago\Domain;

final class ClienteMedioPagoList
{
    /**
     * @var ClienteMedioPago[] The collection
     */
    private array $list;

    /**
     * The constructor.
     *
     * @param ClienteMedioPago ...$collection The collection
     */
    public function __construct(ClienteMedioPago ...$collection)
    {
        $this->list = $collection;
    }

    /**
     * Add model to list.
     *
     * @param ClienteMedioPago $model The model
     *
     * @return void
     */
    public function add(ClienteMedioPago $model): void
    {
        $this->list[] = $model;
    }

    /**
     * Get all collection.
     *
     * @return ClienteMedioPago[] The collection
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

