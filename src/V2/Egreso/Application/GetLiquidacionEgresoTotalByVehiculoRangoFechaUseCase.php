<?php

declare(strict_types=1);

namespace Src\V2\Egreso\Application;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Egreso\Domain\Contracts\EgresoRepositoryContract;

final class GetLiquidacionEgresoTotalByVehiculoRangoFechaUseCase
{
    private EgresoRepositoryContract $repository;

    public function __construct(EgresoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente, array $idVehiculos, string $fechaDesde, string $fechaHasta): array
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        $_fechaDesde = new DateFormat($fechaDesde,false, 'La fecha inicial no tiene el formato correcto');
        $_fechaHasta = new DateFormat($fechaHasta,false, 'La fecha final no tiene el formato correcto');
        return $this->repository->liquidacionTotalByVehiculoRangoFecha($_idCliente, $idVehiculos, $_fechaDesde, $_fechaHasta);
    }
}
