<?php
declare(strict_types=1);

namespace Src\V2\Cronograma\Domain;

final class CronogramaList
{
    /**
     * @var Cronograma[] The collection
     */
    private array $list;

    /**
     * The constructor.
     *
     * @param Cronograma ...$collection The collection
     */
    public function __construct(Cronograma ...$collection)
    {
        $this->list = $collection;
    }

    /**
     * Add model to list.
     *
     * @param Cronograma $model The model
     *
     * @return void
     */
    public function add(Cronograma $model): void
    {
        $this->list[] = $model;
    }

    /**
     * Get all collection.
     *
     * @return Cronograma[] The collection
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

