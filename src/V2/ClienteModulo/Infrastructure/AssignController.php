<?php

namespace Src\V2\ClienteModulo\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\ClienteModulo\Application\AssignUseCase;
use Src\V2\ClienteModulo\Infrastructure\Repositories\EloquentClienteModuloRepository;

final class AssignController
{
    private EloquentClienteModuloRepository $repository;

    public function __construct( EloquentClienteModuloRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request): void
    {
        $user = Auth::user();
        $idCliente             = $request->input('idCliente');
        $modulos          = $request->input('modulos');

        $useCase = new AssignUseCase( $this->repository );
        $useCase->__invoke(
            $idCliente,
            $modulos,
            $user->getId()
        );
    }
}
