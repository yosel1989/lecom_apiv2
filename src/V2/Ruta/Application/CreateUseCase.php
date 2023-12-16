<?php

namespace Src\V2\Ruta\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Ruta\Domain\Contracts\RutaRepositoryContract;

final class CreateUseCase
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
        string $nombre,
        int $idTipo,
        string $idCliente,
        ?string $idSede,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $_nombre = new Text($nombre,false, 100,'El nombre de la Ruta excede los 100 caracteres');
        $_idTipo = new NumericInteger($idTipo);
        $_idCliente = new Id($idCliente,false,'El id del cliente no tiene el formato correcto');
        $_idSede = new Id($idSede,true,'El id de la sede no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->create(
            $_nombre,
            $_idTipo,
            $_idCliente,
            $_idSede,
            $_idEstado,
            $_idUsuarioRegistro
        );

    }
}
