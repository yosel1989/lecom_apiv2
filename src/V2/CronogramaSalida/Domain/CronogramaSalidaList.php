<?php
declare(strict_types=1);

namespace Src\V2\CronogramaSalida\Domain;

final class CronogramaSalidaList
{
    /**
     * @var CronogramaSalida[] The collection
     */
    private array $list;

    /**
     * The constructor.
     *
     * @param CronogramaSalida ...$collection The collection
     */
    public function __construct(CronogramaSalida ...$collection)
    {
        $this->list = $collection;
    }

    /**
     * Add model to list.
     *
     * @param CronogramaSalida $model The model
     *
     * @return void
     */
    public function add(CronogramaSalida $model): void
    {
        $this->list[] = $model;
    }

    /**
     * Get all collection.
     *
     * @return CronogramaSalida[] The collection
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

