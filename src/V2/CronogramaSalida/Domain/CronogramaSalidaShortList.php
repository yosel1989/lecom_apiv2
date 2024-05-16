<?php
declare(strict_types=1);

namespace Src\V2\CronogramaSalida\Domain;


final class CronogramaSalidaShortList
{
    /**
     * @var CronogramaSalidaShort[] The collection
     */
    private array $list;

    /**
     * The constructor.
     *
     * @param CronogramaSalidaShort ...$collection The collection
     */
    public function __construct(CronogramaSalidaShort ...$collection)
    {
        $this->list = $collection;
    }

    /**
     * Add model to list.
     *
     * @param CronogramaSalidaShort $model The model
     *
     * @return void
     */
    public function add(CronogramaSalidaShort $model): void
    {
        $this->list[] = $model;
    }

    /**
     * Get all collection.
     *
     * @return CronogramaSalidaShort[] The collection
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

