<?php

namespace Src\V2\Egreso\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Egreso\Application\UpdateUseCase;
use Src\V2\Egreso\Infrastructure\Repositories\EloquentEgresoRepository;

final class UpdateController
{
    private EloquentEgresoRepository $repository;

    public function __construct( EloquentEgresoRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $idEgreso     = $request->id;
        $nombre          = $request->input('nombre');
        $idCategoria          = $request->input('idCategoria');
        $precioBase          = $request->input('precioBase');
        $idEstado   = $request->input('idEstado');

        $useCase = new UpdateUseCase( $this->repository );
        $useCase->__invoke(
            $idEgreso,
            $nombre,
            $idCategoria,
            $precioBase,
            $idEstado,
            $user->getId()
        );
    }
}
