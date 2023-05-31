<?php


namespace Src\Administracion\TipoIngreso\Infraestructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\Administracion\TipoIngreso\Application\UpdateUseCase;
use Src\Administracion\TipoIngreso\Infraestructure\Repositories\EloquentTipoIngresoRepository;

final class UpdateController
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
        $Id       = $request->id;
        $nombre       = $request->input('nombre');
        $descripcion       = $request->input('descripcion');
        $registraVehiculo       = $request->input('registraVehiculo');
        $registraPersonal       = $request->input('registraPersonal');
        $registraRuta       = $request->input('registraRuta');
        $idClient   = $request->input('idCliente');
        $idStatus   = $request->input('idEstado');

        $createTipoIngresoCase = new UpdateUseCase( $this->repository );
        $createTipoIngresoCase->__invoke(
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
