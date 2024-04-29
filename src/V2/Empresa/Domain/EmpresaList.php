<?php
declare(strict_types=1);

namespace Src\V2\Empresa\Domain;

final class EmpresaList
{
    /**
     * @var Empresa[] The collection
     */
    private array $list;

    /**
     * The constructor.
     *
     * @param Empresa ...$collection The collection
     */
    public function __construct(Empresa ...$collection)
    {
        $this->list = $collection;
    }

    /**
     * Add model to list.
     *
     * @param Empresa $model The model
     *
     * @return void
     */
    public function add(Empresa $model): void
    {
        $this->list[] = $model;
    }

    /**
     * Get all collection.
     *
     * @return Empresa[] The collection
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

