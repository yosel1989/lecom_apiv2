<?php
declare(strict_types=1);

namespace Src\V2\BoletoInterprovincial\Domain;

final class BoletoInterprovincialShortFechaList
{
    /**
     * @var BoletoInterprovincialShortFecha[] The collection
     */
    private array $list;

    /**
     * The constructor.
     *
     * @param BoletoInterprovincialShortFecha ...$collection The collection
     */
    public function __construct(BoletoInterprovincialShortFecha ...$collection)
    {
        $this->list = $collection;
    }

    /**
     * Add model to list.
     *
     * @param BoletoInterprovincialShortFecha $model The model
     *
     * @return void
     */
    public function add(BoletoInterprovincialShortFecha $model): void
    {
        $this->list[] = $model;
    }

    /**
     * Get all collection.
     *
     * @return BoletoInterprovincialShortFecha[] The collection
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

