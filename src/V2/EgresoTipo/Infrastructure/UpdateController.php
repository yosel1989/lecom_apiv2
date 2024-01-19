<?php

namespace Src\V2\EgresoTipo\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\EgresoTipo\Application\UpdateUseCase;
use Src\V2\EgresoTipo\Infrastructure\Repositories\EloquentEgresoTipoRepository;

final class UpdateController
{
    private EloquentEgresoTipoRepository $repository;

    public function __construct( EloquentEgresoTipoRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $idEgresoTipo     = $request->id;
        $nombre          = $request->input('nombre');
        $idCategoria          = $request->input('idCategoria');
        $precioBase          = $request->input('precioBase');
        $idEstado   = $request->input('idEstado');

        $useCase = new UpdateUseCase( $this->repository );
        $useCase->__invoke(
            $idEgresoTipo,
            $nombre,
            $idCategoria,
            $precioBase,
            $idEstado,
            $user->getId()
        );
    }
}
