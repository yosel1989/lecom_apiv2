<?php

namespace Src\V2\Cronograma\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Cronograma\Application\UpdateUseCase;
use Src\V2\Cronograma\Infrastructure\Repositories\EloquentCronogramaRepository;

final class UpdateController
{
    private EloquentCronogramaRepository $repository;

    public function __construct( EloquentCronogramaRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $idCronograma     = $request->id;
        $nombre          = $request->input('nombre');
        $idCategoria          = $request->input('idCategoria');
        $precioBase          = $request->input('precioBase');
        $idEstado   = $request->input('idEstado');

        $useCase = new UpdateUseCase( $this->repository );
        $useCase->__invoke(
            $idCronograma,
            $nombre,
            $idCategoria,
            $precioBase,
            $idEstado,
            $user->getId()
        );
    }
}
