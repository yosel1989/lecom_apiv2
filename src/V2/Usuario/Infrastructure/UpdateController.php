<?php

namespace Src\V2\Usuario\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Usuario\Application\UpdateUseCase;
use Src\V2\Usuario\Infrastructure\Repositories\EloquentUsuarioRepository;

final class UpdateController
{
    private EloquentUsuarioRepository $repository;

    public function __construct( EloquentUsuarioRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $idUsuario       = $request->id;
        $nombre            = $request->input('nombre');
        $apellido        = $request->input('apellido');
        $correo        = $request->input('correo');
        $idPersonal          = $request->input('idPersonal');
        $idPerfil          = $request->input('idPerfil');
        $idEstado        = $request->input('idEstado');

        $useCase = new UpdateUseCase( $this->repository );
        $useCase->__invoke(
            $idUsuario,
            $nombre,
            $apellido,
            $correo,
            $idPersonal,
            $idPerfil,
            $idEstado,
            $user->getId()
        );
    }
}
