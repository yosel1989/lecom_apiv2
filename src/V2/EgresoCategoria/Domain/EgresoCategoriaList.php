<?php
declare(strict_types=1);

namespace Src\V2\EgresoCategoria\Domain;

final class EgresoCategoriaList
{
    /**
     * @var EgresoCategoria[] The categorias
     */
    private array $list;

    /**
     * The constructor.
     *
     * @param EgresoCategoria ...$categorias The categorias
     */
    public function __construct(EgresoCategoria ...$categorias)
    {
        $this->list = $categorias;
    }

    /**
     * Add vehiculo to list.
     *
     * @param EgresoCategoria $categoria The vehiculo
     *
     * @return void
     */
    public function add(EgresoCategoria $categoria): void
    {
        $this->list[] = $categoria;
    }

    /**
     * Get all categorias.
     *
     * @return EgresoCategoria[] The categorias
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

