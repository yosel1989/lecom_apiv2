<?php

namespace Src\V2\ModuloMenu\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\ModuloMenu\Application\CreateUseCase;
use Src\V2\ModuloMenu\Infrastructure\Repositories\EloquentModuloMenuRepository;

final class CreateController
{
    private EloquentModuloMenuRepository $repository;

    public function __construct( EloquentModuloMenuRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request, string $id ): void
    {
        $user = Auth::user();
        $nombre             = $request->input('nombre');
        $icono             = $request->input('icono');
        $codigo          = $request->input('codigo');
        $idEstado           = $request->input('idEstado');

        $useCase = new CreateUseCase( $this->repository );
        $useCase->__invoke(
            $nombre,
            $icono,
            $codigo,
            $idEstado,
            $user->getId()
        );
    }
}
