<?php
declare(strict_types=1);

namespace Src\V2\EgresoCategoria\Domain;

final class EgresoCategoriaShortList
{
    /**
     * @var EgresoCategoriaShort[] The categorias
     */
    private array $list;

    /**
     * The constructor.
     *
     * @param EgresoCategoriaShort ...$categorias The categorias
     */
    public function __construct(EgresoCategoriaShort ...$categorias)
    {
        $this->list = $categorias;
    }

    /**
     * Add vehiculo to list.
     *
     * @param EgresoCategoriaShort $categoria The vehiculo
     *
     * @return void
     */
    public function add(EgresoCategoriaShort $categoria): void
    {
        $this->list[] = $categoria;
    }

    /**
     * Get all categorias.
     *
     * @return EgresoCategoriaShort[] The categorias
     */
    public function all(): array
    {
        return $this->list;
    }


    /**
     * Get count categorias.
     *
     * @return int The categorias
     */
    public function count(): int
    {
        return count($this->list);
    }
}

