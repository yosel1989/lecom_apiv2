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
        $idTipoDocumento            = $request->input('idTipoDocumento');
        $numeroDocumento        = $request->input('numeroDocumento');
        $nombre          = $request->input('nombre');
        $nombreContacto       = $request->input('nombreContacto');
        $correo = $request->input('correo');
        $direccion = $request->input('direccion');
        $telefono1          = $request->input('telefono1');
        $telefono2        = $request->input('telefono2');
        $idEstado       = $request->input('idEstado');

        $useCase = new UpdateUseCase( $this->repository );
        $useCase->__invoke(
            $idCliente,
            $idTipoDocumento,
            $numeroDocumento,
            $nombre,
            $nombreContacto,
            $correo,
            $direccion,
            $telefono1,
            $telefono2,
            $idEstado,
            $user->getId()
        );
    }
}
