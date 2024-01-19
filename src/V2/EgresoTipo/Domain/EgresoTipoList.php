<?php
declare(strict_types=1);

namespace Src\V2\EgresoTipo\Domain;

final class EgresoTipoList
{
    /**
     * @var EgresoTipo[] The collection
     */
    private array $list;

    /**
     * The constructor.
     *
     * @param EgresoTipo ...$collection The collection
     */
    public function __construct(EgresoTipo ...$collection)
    {
        $this->list = $collection;
    }

    /**
     * Add model to list.
     *
     * @param EgresoTipo $model The model
     *
     * @return void
     */
    public function add(EgresoTipo $model): void
    {
        $this->list[] = $model;
    }

    /**
     * Get all collection.
     *
     * @return EgresoTipo[] The collection
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

