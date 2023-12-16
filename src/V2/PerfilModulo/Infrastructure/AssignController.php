<?php

namespace Src\V2\PerfilModulo\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\PerfilModulo\Application\AssignUseCase;
use Src\V2\PerfilModulo\Infrastructure\Repositories\EloquentPerfilModuloRepository;

final class AssignController
{
    private EloquentPerfilModuloRepository $repository;

    public function __construct( EloquentPerfilModuloRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request): void
    {
        $user = Auth::user();
        $idCliente             = $request->input('idCliente');
        $idPerfil     = $request->input('idPerfil');
        $modulos          = $request->input('modulos');

        $useCase = new AssignUseCase( $this->repository );
        $useCase->__invoke(
            $idCliente,
            $idPerfil,
            $modulos,
            $user->getId()
        );
    }
}
