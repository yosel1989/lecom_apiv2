<?php


namespace Src\V2\EgresoDetalle\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\EgresoDetalle\Application\GetReporteByClienteUseCase;
use Src\V2\EgresoDetalle\Domain\EgresoDetalleList;
use Src\V2\EgresoDetalle\Infrastructure\Repositories\EloquentEgresoDetalleRepository;

final class GetReporteByClienteController
{
    private EloquentEgresoDetalleRepository $repository;

    public function __construct(EloquentEgresoDetalleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): EgresoDetalleList
    {
        $user = Auth::user();
        $idUsuario = $user->getId();

        $idClient = $request->input('idCliente');
        $fechaDesde = $request->input('fechaDesde');
        $fechaHasta = $request->input('fechaHasta');
        $idVehiculo = $request->input('idVehiculo');
        $idPersonal = $request->input('idPersonal');
        $useCase = new GetReporteByClienteUseCase($this->repository);
        return $useCase->__invoke($idClient, $fechaDesde, $fechaHasta, $idVehiculo, $idPersonal);
    }

}
