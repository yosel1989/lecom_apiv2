<?php

namespace Src\V2\Perfil\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Perfil\Application\CreateUseCase;
use Src\V2\Perfil\Infrastructure\Repositories\EloquentPerfilRepository;

final class CreateController
{
    private EloquentPerfilRepository $repository;

    public function __construct( EloquentPerfilRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request, string $id ): void
    {
        $user = Auth::user();
        $nombre             = $request->input('nombre');
        $idNivelUsuario     = $request->input('idNivelUsuario');
        $idCliente          = $id;
        $idEstado           = $request->input('idEstado');

        $useCase = new CreateUseCase( $this->repository );
        $useCase->__invoke(
            $nombre,
            $idNivelUsuario,
            $idCliente,
            $idEstado,
            $user->getId()
        );
    }
}
