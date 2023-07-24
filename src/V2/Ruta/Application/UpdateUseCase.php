<?php

namespace Src\V2\Ruta\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Ruta\Domain\Contracts\RutaRepositoryContract;

final class UpdateUseCase
{
    /**
     * @var RutaRepositoryContract
     */
    private RutaRepositoryContract $repository;

    public function __construct( RutaRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idRuta,
        string $nombre,
        int $idTipo,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $_idRuta = new Id($idRuta,false,'El id del Ruta no tiene el formato correcto');
        $_nombre = new Text($nombre, false,100,'El nombre del Ruta excede los 100 caracteres');
        $_idTipo = new NumericInteger($idTipo);
        $_idEstado = new NumericInteger($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->update(
            $_idRuta,
            $_nombre,
            $_idTipo,
            $_idEstado,
            $_idUsuarioRegistro
        );

    }
}
