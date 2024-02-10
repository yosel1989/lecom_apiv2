<?php
declare(strict_types=1);

namespace Src\V2\EgresoMotivo\Domain;

final class EgresoMotivoList
{
    /**
     * @var EgresoMotivo[] The collection
     */
    private array $list;

    /**
     * The constructor.
     *
     * @param EgresoMotivo ...$collection The collection
     */
    public function __construct(EgresoMotivo ...$collection)
    {
        $this->list = $collection;
    }

    /**
     * Add model to list.
     *
     * @param EgresoMotivo $model The model
     *
     * @return void
     */
    public function add(EgresoMotivo $model): void
    {
        $this->list[] = $model;
    }

    /**
     * Get all collection.
     *
     * @return EgresoMotivo[] The collection
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

