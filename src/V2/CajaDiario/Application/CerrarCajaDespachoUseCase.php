<?php

namespace Src\V2\CajaDiario\Application;

use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\V2\CajaDiario\Domain\Contracts\CajaDiarioRepositoryContract;

final class CerrarCajaDespachoUseCase
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
        string $idCajaDiario,
        string $idCliente,
        float $monto,
        string $idUsuarioRegistro
    ): void
    {
        $_idCaja = new Id($idCaja,false,'El id de la caja no tiene el formato correcto');
        $_idCajaDiario = new Id($idCajaDiario,false,'El id de la caja diario no tiene el formato correcto');
        $_idCliente = new Id($idCliente,true,'El id del cliente no tiene el formato correcto');
        $_monto = new NumericFloat($monto);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->cerrarCajaDespacho(
            $_idCaja,
            $_idCajaDiario,
            $_idCliente,
            $_monto,
            $_idUsuarioRegistro
        );

    }
}
