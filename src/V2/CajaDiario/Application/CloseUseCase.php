<?php

namespace Src\V2\CajaDiario\Application;

use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\V2\CajaDiario\Domain\Contracts\CajaDiarioRepositoryContract;

final class CloseUseCase
{
    /**
     * @var CajaDiarioRepositoryContract
     */
    private CajaDiarioRepositoryContract $repository;

    public function __construct( CajaDiarioRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idCajaDiario,
        string $idCaja,
        string $idRuta,
        string $idCliente,
        float $montoFinal,
        string $fechaCierre,
        string $idUsuarioRegistro
    ): void
    {
        $_idCajaDiario = new Id($idCajaDiario,false,'El id de la caja diaria no tiene el formato correcto');
        $_idCaja = new Id($idCaja,false,'El id de la caja no tiene el formato correcto');
        $_idRuta = new Id($idRuta,false,'El id de la ruta no tiene el formato correcto');
        $_idCliente = new Id($idCliente,true,'El id del cliente no tiene el formato correcto');
        $_montoFinal = new NumericFloat($montoFinal);
        $_fechaCierre = new DateTimeFormat($fechaCierre);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->close(
            $_idCajaDiario,
            $_idCaja,
            $_idRuta,
            $_idCliente,
            $_montoFinal,
            $_fechaCierre,
            $_idUsuarioRegistro
        );

    }
}
