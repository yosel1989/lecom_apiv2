<?php

namespace Src\V2\Pos\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Pos\Domain\Contracts\PosRepositoryContract;

final class UpdateUseCase
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
        string $idPos,
        string $nombre,
        string $imei,
        string | null $idSede,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $_idPos = new Id($idPos,false,'El id del pos no tiene el formato correcto');
        $_nombre = new Text($nombre, false,100,'El nombre del pos excede los 100 caracteres');
        $_imei = new Text($imei, true,100,'El imei excede los 25 caracteres');
        $_idSede = new Id($idSede,true,'El id de la sede no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->update(
            $_idPos,
            $_nombre,
            $_imei,
            $_idSede,
            $_idEstado,
            $_idUsuarioRegistro
        );

    }
}
