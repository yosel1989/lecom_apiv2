<?php

namespace Src\V2\CajaDiario\Application;

use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\V2\CajaDiario\Domain\Contracts\CajaDiarioRepositoryContract;

final class CerrarUseCase
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
        string $idCliente,
        float $monto,
        string $idUsuarioRegistro
    ): void
    {
        $_idCaja = new Id($idCaja,false,'El id de la caja no tiene el formato correcto');
        $_idCliente = new Id($idCliente,true,'El id del cliente no tiene el formato correcto');
        $_monto = new NumericFloat($monto);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->cerrar(
            $_idCaja,
            $_idCliente,
            $_monto,
            $_idUsuarioRegistro
        );

    }
}
