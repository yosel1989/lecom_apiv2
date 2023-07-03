<?php

namespace Src\V2\Personal\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Personal\Application\CreateUseCase;
use Src\V2\Personal\Infrastructure\Repositories\EloquentPersonalRepository;

final class CreateController
{
    private EloquentPersonalRepository $repository;

    public function __construct( EloquentPersonalRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $foto            = $request->input('foto');
        $apellido        = $request->input('apellido');
        $nombre          = $request->input('nombre');
        $idCliente       = $request->idCliente;
        $idTipoDocumento = $request->input('idTipoDocumento');
        $numeroDocumento = $request->input('numeroDocumento');
        $correo          = $request->input('correo');
        $idEstado        = $request->input('idEstado');

        $useCase = new CreateUseCase( $this->repository );
        $useCase->__invoke(
            $foto,
            $nombre,
            $apellido,
            $idTipoDocumento,
            $numeroDocumento,
            $correo,
            $idCliente,
            $idEstado,
            $user->getId()
        );
    }
}
