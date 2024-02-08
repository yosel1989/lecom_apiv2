<?php


namespace Src\V2\Liquidacion\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Liquidacion\Application\GetReporteByClienteUseCase;
use Src\V2\Liquidacion\Domain\LiquidacionList;
use Src\V2\Liquidacion\Infrastructure\Repositories\EloquentLiquidacionRepository;

final class GetReporteByClienteController
{
    private EloquentLiquidacionRepository $repository;

    public function __construct(EloquentLiquidacionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): LiquidacionList
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
