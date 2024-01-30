<?php


namespace Src\V2\Egreso\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Egreso\Application\GetReporteByClienteUseCase;
use Src\V2\Egreso\Domain\EgresoList;
use Src\V2\Egreso\Infrastructure\Repositories\EloquentEgresoRepository;

final class GetReporteByClienteController
{
    private EloquentEgresoRepository $repository;

    public function __construct(EloquentEgresoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): EgresoList
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
