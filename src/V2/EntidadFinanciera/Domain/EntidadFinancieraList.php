<?php
declare(strict_types=1);

namespace Src\V2\EntidadFinanciera\Domain;

final class EntidadFinancieraList
{
    /**
     * @var EntidadFinanciera[] The collection
     */
    private array $list;

    /**
     * The constructor.
     *
     * @param EntidadFinanciera ...$collection The collection
     */
    public function __construct(EntidadFinanciera ...$collection)
    {
        $this->list = $collection;
    }

    /**
     * Add model to list.
     *
     * @param EntidadFinanciera $model The model
     *
     * @return void
     */
    public function add(EntidadFinanciera $model): void
    {
        $this->list[] = $model;
    }

    /**
     * Get all collection.
     *
     * @return EntidadFinanciera[] The collection
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

