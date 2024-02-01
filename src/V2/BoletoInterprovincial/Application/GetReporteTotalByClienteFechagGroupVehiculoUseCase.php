<?php

declare(strict_types=1);

namespace Src\V2\BoletoInterprovincial\Application;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\V2\BoletoInterprovincial\Domain\BoletoInterprovincialShortFechaList;
use Src\V2\BoletoInterprovincial\Domain\Contracts\BoletoInterprovincialRepositoryContract;

final class GetReporteTotalByClienteFechagGroupVehiculoUseCase
{
    private BoletoInterprovincialRepositoryContract $repository;

    public function __construct(BoletoInterprovincialRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente, string $fechaDesde, string $fechaHasta): BoletoInterprovincialShortFechaList
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        $_fechaDesce = new DateFormat($fechaDesde,false, 'La fecha inicial no tiene el formato correcto');
        $_fechaHasta = new DateFormat($fechaHasta,false, 'La fecha final no tiene el formato correcto');
        return $this->repository->reporteTotalByClienteFechaGroupVehiculo($_idCliente, $_fechaDesce, $_fechaHasta);
    }
}
