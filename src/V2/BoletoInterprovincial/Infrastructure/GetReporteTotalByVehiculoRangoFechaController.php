<?php


namespace Src\V2\BoletoInterprovincial\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\BoletoInterprovincial\Application\GetReporteTotalByVehiculoRangoFechaUseCase;
use Src\V2\BoletoInterprovincial\Infrastructure\Repositories\EloquentBoletoInterprovincialRepository;

final class GetReporteTotalByVehiculoRangoFechaController
{
    private EloquentBoletoInterprovincialRepository $repository;

    public function __construct(EloquentBoletoInterprovincialRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): array
    {
        $idCliente = $request->input('idCliente');
        $idVehiculo = $request->input('idVehiculo');
        $fechaDesde = $request->input('fechaDesde');
        $fechaHasta = $request->input('fechaHasta');
        $useCase = new GetReporteTotalByVehiculoRangoFechaUseCase($this->repository);
        return $useCase->__invoke($idCliente, $idVehiculo, $fechaDesde, $fechaHasta);
    }

}
