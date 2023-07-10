<?php

namespace Src\V2\Pos\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Pos\Domain\Contracts\PosRepositoryContract;

final class CreateUseCase
{
    /**
     * @var PosRepositoryContract
     */
    private PosRepositoryContract $repository;

    public function __construct( PosRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $nombre,
        string $imei,
        string $idCliente,
        string $idSede,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $_nombre = new Text($nombre,false, 100,'El nombre de la pos excede los 100 caracteres');
        $_imei = new Text($imei,false, 25,'El imei excede los 25 caracteres');
        $_idCliente = new Id($idCliente,false,'El id del cliente no tiene el formato correcto');
        $_idSede = new Id($idSede,false,'El id de la sede no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->create(
            $_nombre,
            $_imei,
            $_idCliente,
            $_idSede,
            $_idEstado,
            $_idUsuarioRegistro
        );

    }
}
