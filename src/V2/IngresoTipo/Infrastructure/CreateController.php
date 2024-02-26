<?php

namespace Src\V2\IngresoTipo\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\IngresoTipo\Application\CreateUseCase;
use Src\V2\IngresoTipo\Infrastructure\Repositories\EloquentIngresoTipoRepository;

final class CreateController
{
    private EloquentIngresoTipoRepository $repository;

    public function __construct( EloquentIngresoTipoRepository $repository )
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
