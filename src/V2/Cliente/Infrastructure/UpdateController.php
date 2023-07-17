<?php

namespace Src\V2\Cliente\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Cliente\Application\UpdateUseCase;
use Src\V2\Cliente\Infrastructure\Repositories\EloquentClienteRepository;

final class UpdateController
{
    private EloquentClienteRepository $repository;

    public function __construct( EloquentClienteRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $idCliente      = $request->id;
        $foto            = $request->input('foto');
        $apellido        = $request->input('apellido');
        $nombre          = $request->input('nombre');
        $idTipoDocumento = $request->input('idTipoDocumento');
        $numeroDocumento = $request->input('numeroDocumento');
        $correo          = $request->input('correo');
        $idSede          = $request->input('idSede');
        $idEstado        = $request->input('idEstado');

        $useCase = new UpdateUseCase( $this->repository );
        $useCase->__invoke(
            $idCliente,
            $foto,
            $nombre,
            $apellido,
            $idTipoDocumento,
            $numeroDocumento,
            $correo,
            $idSede,
            $idEstado,
            $user->getId()
        );
    }
}
