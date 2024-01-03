<?php

namespace Src\V2\PerfilModuloMenu\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\PerfilModuloMenu\Application\AssignUseCase;
use Src\V2\PerfilModuloMenu\Infrastructure\Repositories\EloquentPerfilModuloMenuRepository;

final class AssignController
{
    private EloquentPerfilModuloMenuRepository $repository;

    public function __construct( EloquentPerfilModuloMenuRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request): void
    {
        $user = Auth::user();
        $idCliente             = $request->input('idCliente');
        $idPerfil     = $request->input('idPerfil');
        $idModulo     = $request->input('idModulo');
        $menu          = $request->input('menu');

        $useCase = new AssignUseCase( $this->repository );
        $useCase->__invoke(
            $idCliente,
            $idPerfil,
            $idModulo,
            $menu,
            $user->getId()
        );
    }
}
