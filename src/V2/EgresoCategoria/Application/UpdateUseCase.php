<?php

namespace Src\V2\EgresoCategoria\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\EgresoCategoria\Domain\Contracts\EgresoCategoriaRepositoryContract;

final class UpdateUseCase
{
    /**
     * @var EgresoCategoriaRepositoryContract
     */
    private EgresoCategoriaRepositoryContract $repository;

    public function __construct( EgresoCategoriaRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idEgresoCategoria,
        string $nombre,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $_idEgresoCategoria = new Id($idEgresoCategoria,false,'El id del EgresoCategoria no tiene el formato correcto');
        $_nombre = new Text($nombre, false,100,'El nombre del EgresoCategoria excede los 100 caracteres');
        $_idEstado = new NumericInteger($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->update(
            $_idEgresoCategoria,
            $_nombre,
            $_idEstado,
            $_idUsuarioRegistro
        );

    }
}
