<?php

namespace Src\Administracion\Liquidacion\Infraestructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Src\Administracion\Liquidacion\Application\CreateUseCase;
use Src\Administracion\Liquidacion\Infraestructure\Repositories\EloquentLiquidacionRepository;

final class CreateController
{

    /**
     * @var EloquentLiquidacionRepository
     */
    private $repository;

    public function __construct( EloquentLiquidacionRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $id         = Uuid::uuid4();
        $idTipoLiquidacion       = $request->input('idTipoLiquidacion');
        $fecha       = $request->input('fecha');
        $fechaDesde       = $request->input('fechaDesde');
        $fechaHasta       = $request->input('fechaHasta');
        $idVehiculo       = $request->input('idVehiculo');
        $idPersonal       = $request->input('idPersonal');
        $observacion   = $request->input('observacion');
        $idCliente   = $request->input('idCliente');

        $useCase = new CreateUseCase( $this->repository );
        $useCase->__invoke(
            $id,
            $idTipoLiquidacion,
            $fecha,
            $fechaDesde,
            $fechaHasta,
            $idVehiculo,
            $idPersonal,
            $observacion,
            $idCliente,
            1,
            $user->getId()
        );
    }

}
