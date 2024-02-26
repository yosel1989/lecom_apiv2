<?php
declare(strict_types=1);

namespace Src\V2\IngresoCategoria\Domain;

final class IngresoCategoriaShortList
{
    /**
     * @var IngresoCategoriaShort[] The categorias
     */
    private array $list;

    /**
     * The constructor.
     *
     * @param IngresoCategoriaShort ...$categorias The categorias
     */
    public function __construct(IngresoCategoriaShort ...$categorias)
    {
        $this->list = $categorias;
    }

    /**
     * Add vehiculo to list.
     *
     * @param IngresoCategoriaShort $categoria The vehiculo
     *
     * @return void
     */
    public function add(IngresoCategoriaShort $categoria): void
    {
        $this->list[] = $categoria;
    }

    /**
     * Get all categorias.
     *
     * @return IngresoCategoriaShort[] The categorias
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

