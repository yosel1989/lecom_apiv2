<?php
declare(strict_types=1);

namespace Src\V2\Empresa\Domain;

final class EmpresaShortList
{
    /**
     * @var EmpresaShort[] The collection
     */
    private array $list;

    /**
     * The constructor.
     *
     * @param EmpresaShort ...$collection The collection
     */
    public function __construct(EmpresaShort ...$collection)
    {
        $this->list = $collection;
    }

    /**
     * Add model to list.
     *
     * @param EmpresaShort $model The model
     *
     * @return void
     */
    public function add(EmpresaShort $model): void
    {
        $this->list[] = $model;
    }

    /**
     * Get all collection.
     *
     * @return EmpresaShort[] The collection
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

