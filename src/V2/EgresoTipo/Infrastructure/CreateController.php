<?php

namespace Src\V2\EgresoTipo\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\EgresoTipo\Application\CreateUseCase;
use Src\V2\EgresoTipo\Infrastructure\Repositories\EloquentEgresoTipoRepository;

final class CreateController
{
    private EloquentEgresoTipoRepository $repository;

    public function __construct( EloquentEgresoTipoRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request): void
    {
        $user = Auth::user();
        $nombre             = $request->input('nombre');
        $idCliente          = $request->input('idCliente');
        $idCategoria          = $request->input('idCategoria');
        $precioBase          = $request->input('precioBase');
        $idEstado           = $request->input('idEstado');

        $useCase = new CreateUseCase( $this->repository );
        $useCase->__invoke(
            $nombre,
            $idCliente,
            $idCategoria,
            $precioBase,
            $idEstado,
            $user->getId()
        );
    }
}
