<?php

namespace Src\V2\Caja\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\ValueBoolean;
use Src\V2\Caja\Domain\Contracts\CajaRepositoryContract;

final class CreateUseCase
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
        string $nombre,
        string $idCliente,
        string | null $idSede,
        string | null $idPos,
        bool $blPuntoVenta,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $_nombre = new Text($nombre,false, 100,'El nombre de la caja excede los 100 caracteres');
        $_idCliente = new Id($idCliente,false,'El id del cliente no tiene el formato correcto');
        $_idSede = new Id($idSede,true,'El id de la sede no tiene el formato correcto');
        $_idPos = new Id($idPos,true,'El id del pos no tiene el formato correcto');
        $_blPuntoVenta = new ValueBoolean($blPuntoVenta);
        $_idEstado = new NumericInteger($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->create(
            $_nombre,
            $_idCliente,
            $_idSede,
            $_idPos,
            $_blPuntoVenta,
            $_idEstado,
            $_idUsuarioRegistro
        );

    }
}
