<?php

namespace Src\V2\EgresoCategoria\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\EgresoCategoria\Application\CreateUseCase;
use Src\V2\EgresoCategoria\Infrastructure\Repositories\EloquentEgresoCategoriaRepository;

final class CreateController
{
    private EloquentEgresoCategoriaRepository $repository;

    public function __construct( EloquentEgresoCategoriaRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request): void
    {
        $user = Auth::user();
        $nombre             = $request->input('nombre');
        $idCliente          = $request->input('idCliente');
        $idEstado           = $request->input('idEstado');

        $useCase = new CreateUseCase( $this->repository );
        $useCase->__invoke(
            $nombre,
            $idCliente,
            $idEstado,
            $user->getId()
        );
    }
}
