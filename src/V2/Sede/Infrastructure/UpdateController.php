<?php

namespace Src\V2\Sede\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Sede\Application\UpdateUseCase;
use Src\V2\Sede\Infrastructure\Repositories\EloquentSedeRepository;

final class UpdateController
{
    private EloquentSedeRepository $repository;

    public function __construct( EloquentSedeRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $idSede     = $request->id;
        $nombre          = $request->input('nombre');
        $direccion          = $request->input('direccion');
        $idEstado   = $request->input('idEstado');

        $useCase = new UpdateUseCase( $this->repository );
        $useCase->__invoke(
            $idSede,
            $nombre,
            $direccion,
            $idEstado,
            $user->getId()
        );
    }
}
