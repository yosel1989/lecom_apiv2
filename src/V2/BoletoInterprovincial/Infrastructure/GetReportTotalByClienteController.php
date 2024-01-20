<?php


namespace Src\V2\BoletoInterprovincial\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\BoletoInterprovincial\Application\GetReportByClienteUseCase;
use Src\V2\BoletoInterprovincial\Application\GetReportTotalByClienteUseCase;
use Src\V2\BoletoInterprovincial\Infrastructure\Repositories\EloquentBoletoInterprovincialRepository;

final class GetReportTotalByClienteController
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
        $user = Auth::user();

        $idClient = $request->input('idCliente');
        $idUsuario = $user->getId();
        $fechaDesde = $request->input('fechaDesde');
        $fechaHasta = $request->input('fechaHasta');
        $idRuta = $request->input('$idRuta') === 'null' ? null : $request->input('$idRuta');
        $idVehiculo = $request->input('idVehiculo') === 'null' ? null : $request->input('idVehiculos');
        $useCase = new GetReportTotalByClienteUseCase($this->repository);
        return $useCase->__invoke($idClient, $idUsuario, $fechaDesde, $fechaHasta, $idRuta, $idVehiculo);
    }

}
