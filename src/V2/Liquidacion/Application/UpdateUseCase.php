<?php

namespace Src\V2\Liquidacion\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Liquidacion\Domain\Contracts\LiquidacionRepositoryContract;

final class UpdateUseCase
{
    /**
     * @var LiquidacionRepositoryContract
     */
    private LiquidacionRepositoryContract $repository;

    public function __construct( LiquidacionRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        string $nombre,
        string $idCategoria,
        float $precioBase,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $_id = new Id($id,false,'El id  no tiene el formato correcto');
        $_nombre = new Text($nombre,false, 100,'El nombre de la Liquidacion excede los 100 caracteres');
        $_idCategoria = new Id($idCategoria,false,'El id de la categoria no tiene el formato correcto');
        $_precioBase = new NumericFloat($precioBase);
        $_idEstado = new NumericInteger($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->update(
            $_id,
            $_nombre,
            $_idCategoria,
            $_precioBase,
            $_idEstado,
            $_idUsuarioRegistro
        );

    }
}
