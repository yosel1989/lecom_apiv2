<?php
declare(strict_types=1);

namespace Src\V2\IngresoTipo\Domain;

final class IngresoTipoList
{
    /**
     * @var IngresoTipo[] The collection
     */
    private array $list;

    /**
     * The constructor.
     *
     * @param IngresoTipo ...$collection The collection
     */
    public function __construct(IngresoTipo ...$collection)
    {
        $this->list = $collection;
    }

    /**
     * Add model to list.
     *
     * @param IngresoTipo $model The model
     *
     * @return void
     */
    public function add(IngresoTipo $model): void
    {
        $this->list[] = $model;
    }

    /**
     * Get all collection.
     *
     * @return IngresoTipo[] The collection
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

