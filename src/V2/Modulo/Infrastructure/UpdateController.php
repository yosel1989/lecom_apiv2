<?php

namespace Src\V2\Modulo\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Modulo\Application\UpdateUseCase;
use Src\V2\Modulo\Infrastructure\Repositories\EloquentModuloRepository;

final class UpdateController
{
    private EloquentModuloRepository $repository;

    public function __construct( EloquentModuloRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $idModulo     = $request->id;
        $nombre          = $request->input('nombre');
        $icono          = $request->input('icono');
        $codigo          = $request->input('codigo');
        $idEstado   = $request->input('idEstado');

        $useCase = new UpdateUseCase( $this->repository );
        $useCase->__invoke(
            $idModulo,
            $nombre,
            $icono,
            $codigo,
            $idEstado,
            $user->getId()
        );
    }
}
