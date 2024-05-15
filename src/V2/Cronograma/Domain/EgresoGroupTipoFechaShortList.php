<?php
declare(strict_types=1);

namespace Src\V2\Cronograma\Domain;

final class CronogramaGroupTipoFechaShortList
{
    /**
     * @var CronogramaGroupTipoFechaShort[] The collection
     */
    private array $list;

    /**
     * The constructor.
     *
     * @param CronogramaGroupTipoFechaShort ...$collection The collection
     */
    public function __construct(CronogramaGroupTipoFechaShort ...$collection)
    {
        $this->list = $collection;
    }

    /**
     * Add model to list.
     *
     * @param CronogramaGroupTipoFechaShort $model The model
     *
     * @return void
     */
    public function add(CronogramaGroupTipoFechaShort $model): void
    {
        $this->list[] = $model;
    }

    /**
     * Get all collection.
     *
     * @return CronogramaGroupTipoFechaShort[] The collection
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

