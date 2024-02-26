<?php

namespace Src\V2\IngresoCategoria\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\IngresoCategoria\Application\UpdateUseCase;
use Src\V2\IngresoCategoria\Infrastructure\Repositories\EloquentIngresoCategoriaRepository;

final class UpdateController
{
    private EloquentIngresoCategoriaRepository $repository;

    public function __construct( EloquentIngresoCategoriaRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $idIngresoCategoria     = $request->id;
        $nombre          = $request->input('nombre');
        $idEstado   = $request->input('idEstado');

        $useCase = new UpdateUseCase( $this->repository );
        $useCase->__invoke(
            $idIngresoCategoria,
            $nombre,
            $idEstado,
            $user->getId()
        );
    }
}
