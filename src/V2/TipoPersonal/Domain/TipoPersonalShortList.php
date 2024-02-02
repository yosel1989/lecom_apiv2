<?php
declare(strict_types=1);

namespace Src\V2\TipoPersonal\Domain;


final class TipoPersonalShortList
{
    /**
     * @var TipoPersonalShort[] The TipoPersonalShorts
     */
    private array $collection;

    /**
     * The constructor.
     *
     * @param TipoPersonalShort ...$TipoPersonalShort The TipoPersonalShorts
     */
    public function __construct(TipoPersonalShort ...$TipoPersonalShort)
    {
        $this->list = $TipoPersonalShort;
    }

    /**
     * Add TipoPersonalShort to list.
     *
     * @param TipoPersonalShort $TipoPersonalShort The TipoPersonalShort
     *
     * @return void
     */
    public function add(TipoPersonalShort $TipoPersonalShort): void
    {
        $this->list[] = $TipoPersonalShort;
    }

    /**
     * Get all TipoPersonalShorts.
     *
     * @return TipoPersonalShort[] The TipoPersonalShorts
     */
    public function all(): array
    {
        return $this->list;
    }


    /**
     * Get count TipoPersonalShorts.
     *
     * @return int The TipoPersonalShorts
     */
    public function count(): int
    {
        return count($this->list);
    }
}

