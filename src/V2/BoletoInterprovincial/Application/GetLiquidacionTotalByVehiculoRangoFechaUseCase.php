<?php

declare(strict_types=1);

namespace Src\V2\BoletoInterprovincial\Application;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\V2\BoletoInterprovincial\Domain\BoletoInterprovincialShortFechaList;
use Src\V2\BoletoInterprovincial\Domain\Contracts\BoletoInterprovincialRepositoryContract;

final class GetLiquidacionTotalByVehiculoRangoFechaUseCase
{
    private BoletoInterprovincialRepositoryContract $repository;

    public function __construct(BoletoInterprovincialRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente, array $idVehiculos, string $fechaDesde, string $fechaHasta): BoletoInterprovincialShortFechaList
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        $_fechaDesde = new DateFormat($fechaDesde,false, 'El fecha inicio no tiene el formato correcto');
        $_fechaHasta= new DateFormat($fechaHasta,false, 'El fecha final no tiene el formato correcto');
        return $this->repository->liquidacionTotalByVehiculoRangoFecha($_idCliente, $idVehiculos, $_fechaDesde, $_fechaHasta);
    }
}
