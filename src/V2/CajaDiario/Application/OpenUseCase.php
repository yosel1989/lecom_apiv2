<?php

namespace Src\V2\CajaDiario\Application;

use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\V2\CajaDiario\Domain\Contracts\CajaDiarioRepositoryContract;

final class OpenUseCase
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
        string $idCaja,
        string $idRuta,
        string $idCliente,
        float $montoIncial,
        string $fechaApertura,
        string $idUsuarioRegistro
    ): Id
    {
        $_idCaja = new Id($idCaja,false,'El id de la caja no tiene el formato correcto');
        $_idRuta = new Id($idRuta,false,'El id de la ruta no tiene el formato correcto');
        $_idCliente = new Id($idCliente,false,'El id del cliente no tiene el formato correcto');
        $_montoInicial = new NumericFloat($montoIncial);
        $_fechaApertura = new DateTimeFormat($fechaApertura);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        return $this->repository->open(
            $_idCaja,
            $_idRuta,
            $_idCliente,
            $_montoInicial,
            $_fechaApertura,
            $_idUsuarioRegistro
        );

    }
}
