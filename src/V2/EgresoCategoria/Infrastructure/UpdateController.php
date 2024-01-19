<?php

namespace Src\V2\EgresoCategoria\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\EgresoCategoria\Application\UpdateUseCase;
use Src\V2\EgresoCategoria\Infrastructure\Repositories\EloquentEgresoCategoriaRepository;

final class UpdateController
{
    private EloquentEgresoCategoriaRepository $repository;

    public function __construct( EloquentEgresoCategoriaRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $idEgresoCategoria     = $request->id;
        $nombre          = $request->input('nombre');
        $idEstado   = $request->input('idEstado');

        $useCase = new UpdateUseCase( $this->repository );
        $useCase->__invoke(
            $idEgresoCategoria,
            $nombre,
            $idEstado,
            $user->getId()
        );
    }
}
