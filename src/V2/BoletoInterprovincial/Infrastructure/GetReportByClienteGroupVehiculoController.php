<?php


namespace Src\V2\BoletoInterprovincial\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\BoletoInterprovincial\Application\GetReportByUsuarioClienteUseCase;
use Src\V2\BoletoInterprovincial\Infrastructure\Repositories\EloquentBoletoInterprovincialRepository;
use Src\V2\Vehiculo\Application\GetListByUsuarioUseCase;
use Src\V2\Vehiculo\Infrastructure\Repositories\EloquentVehiculoRepository;

final class GetReportByClienteGroupVehiculoController
{
    private EloquentBoletoInterprovincialRepository $repository;
    private EloquentVehiculoRepository $vehiculoRepository;

    public function __construct(EloquentBoletoInterprovincialRepository $repository, EloquentVehiculoRepository $vehiculoRepository)
    {
        $this->repository = $repository;
        $this->vehiculoRepository = $vehiculoRepository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): array
    {
        $user = Auth::user();

        $idClient = $request->id;
        $fechaDesde = $request->fechaDesde;
        $fechaHasta = $request->fechaHasta;
        $idRuta = $request->idRuta === 'null' ? null : $request->idRuta;

        $vehiculosUseCase = new GetListByUsuarioUseCase($this->vehiculoRepository);
        $vehiculos = $vehiculosUseCase->__invoke($user->getId(), $idClient);


        $useCase = new GetReportByUsuarioClienteUseCase($this->repository);
        return $useCase->__invoke($idClient, $fechaDesde, $fechaHasta, $idRuta, $vehiculos);
    }

}
