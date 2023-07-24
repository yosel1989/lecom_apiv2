<?php

namespace Src\V2\Ruta\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Ruta\Application\CreateUseCase;
use Src\V2\Ruta\Infrastructure\Repositories\EloquentRutaRepository;

final class CreateController
{
    private EloquentRutaRepository $repository;

    public function __construct( EloquentRutaRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request, string $id ): void
    {
        $user = Auth::user();
        $nombre             = $request->input('nombre');
        $idTipo             = $request->input('idTipo');
        $idCliente          = $id;
        $idEstado           = $request->input('idEstado');

        $useCase = new CreateUseCase( $this->repository );
        $useCase->__invoke(
            $nombre,
            $idTipo,
            $idCliente,
            $idEstado,
            $user->getId()
        );
    }
}
