<?php
declare(strict_types=1);

namespace Src\V2\ComprobanteElectronicoItem\Domain;

final class ComprobanteElectronicoItemList
{
    /**
     * @var ComprobanteElectronicoItem[] The collection
     */
    private array $list;

    /**
     * The constructor.
     *
     * @param ComprobanteElectronicoItem ...$collection The collection
     */
    public function __construct(ComprobanteElectronicoItem ...$collection)
    {
        $this->list = $collection;
    }

    /**
     * Add model to list.
     *
     * @param ComprobanteElectronicoItem $model The model
     *
     * @return void
     */
    public function add(ComprobanteElectronicoItem $model): void
    {
        $this->list[] = $model;
    }

    /**
     * Get all collection.
     *
     * @return ComprobanteElectronicoItem[] The collection
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

