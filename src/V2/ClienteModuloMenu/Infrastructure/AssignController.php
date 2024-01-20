<?php

namespace Src\V2\ClienteModuloMenu\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\ClienteModuloMenu\Application\AssignUseCase;
use Src\V2\ClienteModuloMenu\Infrastructure\Repositories\EloquentClienteModuloMenuRepository;

final class AssignController
{
    private EloquentClienteModuloMenuRepository $repository;

    public function __construct( EloquentClienteModuloMenuRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request): void
    {
        $user = Auth::user();
        $idCliente             = $request->input('idCliente');
        $idModulo     = $request->input('idModulo');
        $menu          = $request->input('menu');

        $useCase = new AssignUseCase( $this->repository );
        $useCase->__invoke(
            $idCliente,
            $idModulo,
            $menu,
            $user->getId()
        );
    }
}
