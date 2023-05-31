<?php

namespace Src\Administracion\TipoIngreso\Infraestructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Src\Administracion\TipoIngreso\Application\CreateUseCase;
use Src\Administracion\TipoIngreso\Infraestructure\Repositories\EloquentTipoIngresoRepository;

final class CreateController
{

    /**
     * @var EloquentTipoIngresoRepository
     */
    private $repository;

    public function __construct( EloquentTipoIngresoRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $id         = Uuid::uuid4();
        $nombre       = $request->input('nombre');
        $descripcion       = $request->input('descripcion');
        $registraVehiculo       = $request->input('registraVehiculo');
        $registraPersonal       = $request->input('registraPersonal');
        $registraRuta       = $request->input('registraRuta');
        $idClient   = $request->input('idCliente');
        $idStatus   = $request->input('idEstado');

        $createTipoIngresoCase = new CreateUseCase( $this->repository );
        $createTipoIngresoCase->__invoke(
            $id,
            $nombre,
            $descripcion,
            $registraVehiculo,
            $registraPersonal,
            $registraRuta,
            $idClient,
            $idStatus,
            $user->getId()
        );
    }
}
