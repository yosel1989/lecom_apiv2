<?php
declare(strict_types=1);

namespace Src\V2\ClienteMedioPago\Domain;

final class ClienteMedioPagoShortList
{
    /**
     * @var ClienteMedioPagoShort[] The collection
     */
    private array $list;

    /**
     * The constructor.
     *
     * @param ClienteMedioPagoShort ...$collection The collection
     */
    public function __construct(ClienteMedioPagoShort ...$collection)
    {
        $this->list = $collection;
    }

    /**
     * Add model to list.
     *
     * @param ClienteMedioPagoShort $model The model
     *
     * @return void
     */
    public function add(ClienteMedioPagoShort $model): void
    {
        $this->list[] = $model;
    }

    /**
     * Get all collection.
     *
     * @return ClienteMedioPagoShort[] The collection
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

