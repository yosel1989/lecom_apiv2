<?php
declare(strict_types=1);

namespace Src\V2\IngresoCategoria\Domain;

final class IngresoCategoriaList
{
    /**
     * @var IngresoCategoria[] The categorias
     */
    private array $list;

    /**
     * The constructor.
     *
     * @param IngresoCategoria ...$categorias The categorias
     */
    public function __construct(IngresoCategoria ...$categorias)
    {
        $this->list = $categorias;
    }

    /**
     * Add vehiculo to list.
     *
     * @param IngresoCategoria $categoria The vehiculo
     *
     * @return void
     */
    public function add(IngresoCategoria $categoria): void
    {
        $this->list[] = $categoria;
    }

    /**
     * Get all categorias.
     *
     * @return IngresoCategoria[] The categorias
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

