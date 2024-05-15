<?php


namespace Src\V2\CajaTraslado\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\CajaTraslado\Application\GetReporteByClienteUseCase;
use Src\V2\CajaTraslado\Domain\CajaTrasladoList;
use Src\V2\CajaTraslado\Infrastructure\Repositories\EloquentCajaTrasladoRepository;

final class GetReporteByClienteController
{
    private EloquentCajaTrasladoRepository $repository;

    public function __construct(EloquentCajaTrasladoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): CajaTrasladoList
    {
        $user = Auth::user();
        $idUsuario = $user->getId();

        $idClient = $request->input('idCliente');
        $fechaDesde = $request->input('fechaDesde');
        $fechaHasta = $request->input('fechaHasta');
//        $idVehiculo = $request->input('idVehiculo');
//        $idPersonal = $request->input('idPersonal');
        $useCase = new GetReporteByClienteUseCase($this->repository);
        return $useCase->__invoke($idClient, $fechaDesde, $fechaHasta);
    }

}
