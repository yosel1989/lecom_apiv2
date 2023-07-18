<?php

namespace Src\V2\Caja\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Caja\Domain\Contracts\CajaRepositoryContract;

final class UpdateUseCase
{
    /**
     * @var CajaRepositoryContract
     */
    private CajaRepositoryContract $repository;

    public function __construct( CajaRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idCaja,
        string $nombre,
        string | null $idSede,
        string | null $idPos,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $_idCaja = new Id($idCaja,false,'El id del caja no tiene el formato correcto');
        $_nombre = new Text($nombre, false,100,'El nombre del caja excede los 100 caracteres');
        $_idSede = new Id($idSede,true,'El id de la sede no tiene el formato correcto');
        $_idPos = new Id($idPos,true,'El id del pos no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->update(
            $_idCaja,
            $_nombre,
            $_idSede,
            $_idPos,
            $_idEstado,
            $_idUsuarioRegistro
        );

    }
}
