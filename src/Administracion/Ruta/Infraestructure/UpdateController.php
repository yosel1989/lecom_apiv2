<?php


namespace Src\Administracion\Ruta\Infraestructure;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\Administracion\Ruta\Application\UpdateUseCase;
use Src\Administracion\Ruta\Infraestructure\Repositories\EloquentRutaRepository;

final class UpdateController
{

    /**
     * @var EloquentRutaRepository
     */
    private $repository;

    public function __construct( EloquentRutaRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $Id       = $request->id;
        $name       = $request->input('nombre');
        $code      = $request->input('codigo');
        $idClient   = $request->input('idCliente');
        $idStatus   = $request->input('idEstado');

        $createRutaCase = new UpdateUseCase( $this->repository );
        $createRutaCase->__invoke(
            $Id,
            $name,
            $code,
            $idStatus,
            $user->getId(),
            $idClient
        );
    }
}
