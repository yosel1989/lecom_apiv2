<?php
declare(strict_types=1);

namespace Src\V2\IngresoTipo\Domain;

final class IngresoTipoShortList
{
    /**
     * @var IngresoTipoShort[] The collection
     */
    private array $list;

    /**
     * The constructor.
     *
     * @param IngresoTipoShort ...$collection The collection
     */
    public function __construct(IngresoTipoShort ...$collection)
    {
        $this->list = $collection;
    }

    /**
     * Add model to list.
     *
     * @param IngresoTipoShort $model The model
     *
     * @return void
     */
    public function add(IngresoTipoShort $model): void
    {
        $this->list[] = $model;
    }

    /**
     * Get all collection.
     *
     * @return IngresoTipoShort[] The collection
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

