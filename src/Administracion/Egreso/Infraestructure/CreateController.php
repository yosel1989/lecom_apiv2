<?php

namespace Src\Administracion\Egreso\Infraestructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Src\Administracion\Egreso\Application\CreateUseCase;
use Src\Administracion\Egreso\Infraestructure\Repositories\EloquentEgresoRepository;

final class CreateController
{

    /**
     * @var EloquentEgresoRepository
     */
    private $repository;

    public function __construct( EloquentEgresoRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $id         = Uuid::uuid4();
        $fecha       = $request->input('fecha');
        $idTipoEgreso       = $request->input('idTipoEgreso');
        $idVehiculo       = $request->input('idVehiculo');
        $idPersonal       = $request->input('idPersonal');
        $idRuta   = $request->input('idRuta');
        $monto   = (float)$request->input('monto');
        $observacion   = $request->input('observacion');
        $idCliente   = $request->input('idCliente');

        $useCase = new CreateUseCase( $this->repository );
        $useCase->__invoke(
            $id,
            $fecha,
            $idTipoEgreso,
            $idVehiculo,
            $idPersonal,
            $idRuta,
            $idCliente,
            $monto,
            $observacion,
            1,
            $user->getId()
        );
    }
}
