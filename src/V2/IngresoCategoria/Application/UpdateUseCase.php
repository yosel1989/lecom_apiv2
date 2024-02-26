<?php

namespace Src\V2\IngresoCategoria\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\IngresoCategoria\Domain\Contracts\IngresoCategoriaRepositoryContract;

final class UpdateUseCase
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
        string $idIngresoCategoria,
        string $nombre,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $_idIngresoCategoria = new Id($idIngresoCategoria,false,'El id del categoria no tiene el formato correcto');
        $_nombre = new Text($nombre, false,100,'El nombre del categoria excede los 100 caracteres');
        $_idEstado = new NumericInteger($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->update(
            $_idIngresoCategoria,
            $_nombre,
            $_idEstado,
            $_idUsuarioRegistro
        );

    }
}
