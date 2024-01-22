<?php


namespace Src\V2\BoletoInterprovincial\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\BoletoInterprovincial\Application\GetReporteTotalByVehiculoFechaUseCase;
use Src\V2\BoletoInterprovincial\Infrastructure\Repositories\EloquentBoletoInterprovincialRepository;

final class GetReporteTotalByVehiculoFechaController
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
        $fecha = $request->input('fecha');
        $useCase = new GetReporteTotalByVehiculoFechaUseCase($this->repository);
        return $useCase->__invoke($idCliente, $idVehiculo, $fecha);
    }

}
