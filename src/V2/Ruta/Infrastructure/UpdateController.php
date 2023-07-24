<?php

namespace Src\V2\Ruta\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Ruta\Application\UpdateUseCase;
use Src\V2\Ruta\Infrastructure\Repositories\EloquentRutaRepository;

final class UpdateController
{
    private EloquentRutaRepository $repository;

    public function __construct( EloquentRutaRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $idRuta     = $request->id;
        $nombre          = $request->input('nombre');
        $idTipo          = $request->input('idTipo');
        $idEstado   = $request->input('idEstado');

        $useCase = new UpdateUseCase( $this->repository );
        $useCase->__invoke(
            $idRuta,
            $nombre,
            $idTipo,
            $idEstado,
            $user->getId()
        );
    }
}
