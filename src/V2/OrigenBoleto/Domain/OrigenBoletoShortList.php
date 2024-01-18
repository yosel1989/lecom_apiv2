<?php
declare(strict_types=1);

namespace Src\V2\OrigenBoleto\Domain;

final class OrigenBoletoShortList
{
    /**
     * @var OrigenBoletoShort[]
     */
    private array $list;

    /**
     * The constructor.
     *
     * @param OrigenBoletoShort ...$model
     */
    public function __construct(OrigenBoletoShort ...$model)
    {
        $this->list = $model;
    }

    /**
     * Add model to list.
     *
     * @param OrigenBoletoShort $model
     *
     * @return void
     */
    public function add(OrigenBoletoShort $model): void
    {
        $this->list[] = $model;
    }

    /**
     * Get all
     *
     * @return OrigenBoletoShort[]
     */
    public function all(): array
    {
        return $this->list;
    }


    /**
     * Get count
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->list);
    }
}

