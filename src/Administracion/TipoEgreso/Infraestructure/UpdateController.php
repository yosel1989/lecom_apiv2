<?php


namespace Src\Administracion\TipoEgreso\Infraestructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\Administracion\TipoEgreso\Application\UpdateUseCase;
use Src\Administracion\TipoEgreso\Infraestructure\Repositories\EloquentTipoEgresoRepository;

final class UpdateController
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
        $Id       = $request->id;
        $nombre       = $request->input('nombre');
        $descripcion       = $request->input('descripcion');
        $registraVehiculo       = $request->input('registraVehiculo');
        $registraPersonal       = $request->input('registraPersonal');
        $registraRuta       = $request->input('registraRuta');
        $idClient   = $request->input('idCliente');
        $idStatus   = $request->input('idEstado');

        $createTipoEgresoCase = new UpdateUseCase( $this->repository );
        $createTipoEgresoCase->__invoke(
            $Id,
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
