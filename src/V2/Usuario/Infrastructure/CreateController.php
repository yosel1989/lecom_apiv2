<?php

namespace Src\V2\Usuario\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Usuario\Application\CreateUseCase;
use Src\V2\Usuario\Infrastructure\Repositories\EloquentUsuarioRepository;

final class CreateController
{
    private EloquentUsuarioRepository $repository;

    public function __construct( EloquentUsuarioRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $nombre            = $request->input('nombre');
        $apellido        = $request->input('apellido');
        $correo        = $request->input('correo');
        $usuario          = $request->input('usuario');
        $clave          = $request->input('clave');
        $idPersonal          = $request->input('idPersonal');
        $idPerfil          = $request->input('idPerfil');
        $idSede         = $request->input('idSede');
        $idCliente       = $request->idCliente;
        $idEstado        = $request->input('idEstado');
        $idNivelUsuario        = $request->input('idNivelUsuario');

        $useCase = new CreateUseCase( $this->repository );
        $useCase->__invoke(
            $usuario,
            $clave,
            $nombre,
            $apellido,
            $correo,
            $idPersonal,
            $idPerfil,
            $idSede,
            $idCliente,
            $idNivelUsuario,
            $idEstado,
            $user->getId()
        );
    }
}
