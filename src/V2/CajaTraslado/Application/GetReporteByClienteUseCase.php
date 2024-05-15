<?php

declare(strict_types=1);

namespace Src\V2\CajaTraslado\Application;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\V2\CajaTraslado\Domain\Contracts\CajaTrasladoRepositoryContract;

final class GetReporteByClienteUseCase
{
    private CajaTrasladoRepositoryContract $repository;

    public function __construct(CajaTrasladoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente, string $fechaDesde, string $fechaHasta): \Src\V2\CajaTraslado\Domain\CajaTrasladoList
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        $_fechaDesde = new DateFormat($fechaDesde,false, 'El fecha inicio no tiene el formato correcto');
        $_fechaHasta= new DateFormat($fechaHasta,false, 'El fecha final no tiene el formato correcto');
        return $this->repository->reporteByCliente($_idCliente, $_fechaDesde, $_fechaHasta);
    }
}
