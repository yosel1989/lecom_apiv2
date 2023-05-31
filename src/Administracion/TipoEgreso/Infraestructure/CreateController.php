<?php

namespace Src\Administracion\TipoEgreso\Infraestructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Src\Administracion\TipoEgreso\Application\CreateUseCase;
use Src\Administracion\TipoEgreso\Infraestructure\Repositories\EloquentTipoEgresoRepository;

final class CreateController
{

    /**
     * @var EloquentTipoEgresoRepository
     */
    private $repository;

    public function __construct( EloquentTipoEgresoRepository $repository )
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

        $createTipoEgresoCase = new CreateUseCase( $this->repository );
        $createTipoEgresoCase->__invoke(
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
