<?php

namespace Src\V2\EgresoTipo\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\EgresoTipo\Domain\Contracts\EgresoTipoRepositoryContract;

final class CreateUseCase
{
    /**
     * @var EgresoTipoRepositoryContract
     */
    private EgresoTipoRepositoryContract $repository;

    public function __construct( EgresoTipoRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $nombre,
        string $idCliente,
        string $idCategoria,
        float $precioBase,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $_nombre = new Text($nombre,false, 100,'El nombre de la EgresoTipo excede los 100 caracteres');
        $_idCliente = new Id($idCliente,false,'El id del cliente no tiene el formato correcto');
        $_idCategoria = new Id($idCategoria,false,'El id de la categoria no tiene el formato correcto');
        $_precioBase = new NumericFloat($precioBase);
        $_idEstado = new NumericInteger($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->create(
            $_nombre,
            $_idCliente,
            $_idCategoria,
            $_precioBase,
            $_idEstado,
            $_idUsuarioRegistro
        );

    }
}
