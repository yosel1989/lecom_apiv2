<?php

namespace Src\V2\CajaDiario\Application;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\V2\CajaDiario\Domain\Contracts\CajaDiarioRepositoryContract;

final class ReporteUseCase
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
        string $fechaFinal
    ): array
    {

        $_idCliente = new Id($idCliente,false,'El id del cliente no tiene el formato correcto');
        $_fechaInicio = new DateFormat($fechaInicio);
        $_fechaFinal = new DateFormat($fechaFinal);

        return $this->repository->reporte(
            $_idCliente,
            $_fechaInicio,
            $_fechaFinal
        );

    }
}
