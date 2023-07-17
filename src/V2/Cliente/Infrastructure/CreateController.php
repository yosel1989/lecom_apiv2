<?php

namespace Src\V2\Cliente\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Cliente\Application\CreateUseCase;
use Src\V2\Cliente\Infrastructure\Repositories\EloquentClienteRepository;

final class CreateController
{
    private EloquentClienteRepository $repository;

    public function __construct( EloquentClienteRepository $repository )
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
        $idSede        = $request->input('idSede');
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
            $idSede,
            $idEstado,
            $user->getId()
        );
    }
}
