<?php
declare(strict_types=1);

namespace Src\V2\EgresoTipo\Domain;

final class EgresoTipoShortList
{
    /**
     * @var EgresoTipoShort[] The collection
     */
    private array $list;

    /**
     * The constructor.
     *
     * @param EgresoTipoShort ...$collection The collection
     */
    public function __construct(EgresoTipoShort ...$collection)
    {
        $this->list = $collection;
    }

    /**
     * Add model to list.
     *
     * @param EgresoTipoShort $model The model
     *
     * @return void
     */
    public function add(EgresoTipoShort $model): void
    {
        $this->list[] = $model;
    }

    /**
     * Get all collection.
     *
     * @return EgresoTipoShort[] The collection
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

