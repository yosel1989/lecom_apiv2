<?php

namespace Src\V2\IngresoCategoria\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\IngresoCategoria\Domain\Contracts\IngresoCategoriaRepositoryContract;

final class CreateUseCase
{
    /**
     * @var IngresoCategoriaRepositoryContract
     */
    private IngresoCategoriaRepositoryContract $repository;

    public function __construct( IngresoCategoriaRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $nombre,
        string $idCliente,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $_nombre = new Text($nombre,false, 100,'El nombre de la categoria excede los 100 caracteres');
        $_idCliente = new Id($idCliente,false,'El id del cliente no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->create(
            $_nombre,
            $_idCliente,
            $_idEstado,
            $_idUsuarioRegistro
        );

    }
}
