<?php
declare(strict_types=1);

namespace Src\V2\TipoPersonal\Domain;

final class TipoPersonalList
{
    /**
     * @var TipoPersonal[] The TipoPersonals
     */
    private array $collection;

    /**
     * The constructor.
     *
     * @param TipoPersonal ...$TipoPersonal The TipoPersonals
     */
    public function __construct(TipoPersonal ...$TipoPersonal)
    {
        $this->list = $TipoPersonal;
    }

    /**
     * Add TipoPersonal to list.
     *
     * @param TipoPersonal $TipoPersonal The TipoPersonal
     *
     * @return void
     */
    public function add(TipoPersonal $TipoPersonal): void
    {
        $this->list[] = $TipoPersonal;
    }

    /**
     * Get all TipoPersonals.
     *
     * @return TipoPersonal[] The TipoPersonals
     */
    public function all(): array
    {
        return $this->list;
    }


    /**
     * Get count TipoPersonals.
     *
     * @return int The TipoPersonals
     */
    public function count(): int
    {
        return count($this->list);
    }
}

