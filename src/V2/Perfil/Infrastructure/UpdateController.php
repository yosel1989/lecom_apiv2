<?php

namespace Src\V2\Perfil\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Perfil\Application\UpdateUseCase;
use Src\V2\Perfil\Infrastructure\Repositories\EloquentPerfilRepository;

final class UpdateController
{
    private EloquentPerfilRepository $repository;

    public function __construct( EloquentPerfilRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $idPerfil     = $request->id;
        $nombre          = $request->input('nombre');
        $idEstado   = $request->input('idEstado');

        $useCase = new UpdateUseCase( $this->repository );
        $useCase->__invoke(
            $idPerfil,
            $nombre,
            $idEstado,
            $user->getId()
        );
    }
}
