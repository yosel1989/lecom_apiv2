<?php

namespace Src\Administracion\Ingreso\Infraestructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Src\Administracion\Ingreso\Application\CreateUseCase;
use Src\Administracion\Ingreso\Infraestructure\Repositories\EloquentIngresoRepository;

final class CreateController
{

    /**
     * @var EloquentIngresoRepository
     */
    private $repository;

    public function __construct( EloquentIngresoRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $id         = Uuid::uuid4();
        $fecha       = $request->input('fecha');
        $idTipoIngreso       = $request->input('idTipoIngreso');
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
            $idTipoIngreso,
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
