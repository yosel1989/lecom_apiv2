<?php

namespace Src\V2\CajaDiario\Application;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\V2\CajaDiario\Domain\Contracts\CajaDiarioRepositoryContract;

final class ReporteSaldoUseCase
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
        string $idCliente,
        string $fechaInicio,
        string $fechaFinal,
        ?string $idCaja
    ): array
    {

        $_idCliente = new Id($idCliente,false,'El id del cliente no tiene el formato correcto');
        $_fechaInicio = new DateFormat($fechaInicio);
        $_fechaFinal = new DateFormat($fechaFinal);
        $_idCaja = new Id($idCaja,true,'El id de la caja no tiene el formato correcto');


        return $this->repository->reporteSaldo(
            $_idCliente,
            $_fechaInicio,
            $_fechaFinal,
            $_idCaja
        );

    }
}
