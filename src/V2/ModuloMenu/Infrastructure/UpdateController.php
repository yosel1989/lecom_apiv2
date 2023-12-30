<?php

namespace Src\V2\ModuloMenu\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\ModuloMenu\Application\UpdateUseCase;
use Src\V2\ModuloMenu\Infrastructure\Repositories\EloquentModuloMenuRepository;

final class UpdateController
{
    private EloquentModuloMenuRepository $repository;

    public function __construct( EloquentModuloMenuRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $idModuloMenu     = $request->id;
        $nombre          = $request->input('nombre');
        $icono          = $request->input('icono');
        $codigo          = $request->input('codigo');
        $idEstado   = $request->input('idEstado');

        $useCase = new UpdateUseCase( $this->repository );
        $useCase->__invoke(
            $idModuloMenu,
            $nombre,
            $icono,
            $codigo,
            $idEstado,
            $user->getId()
        );
    }
}
