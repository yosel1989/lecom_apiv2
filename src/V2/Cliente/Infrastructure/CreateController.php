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
        $idTipoDocumento            = $request->input('idTipoDocumento');
        $numeroDocumento        = $request->input('numeroDocumento');
        $nombre          = $request->input('nombre');
        $nombreContacto       = $request->input('nombreContacto');
        $correo = $request->input('correo');
        $direccion = $request->input('direccion');
        $telefono1          = $request->input('telefono1');
        $telefono2        = $request->input('telefono2');
        $idTipo        = $request->input('idTipo');
        $idCliente       = $request->input('idCliente');
        $idEstado       = $request->input('idEstado');

        $useCase = new CreateUseCase( $this->repository );
        $useCase->__invoke(
            $idTipoDocumento,
            $numeroDocumento,
            $nombre,
            $nombreContacto,
            $correo,
            $direccion,
            $telefono1,
            $telefono2,
            $idTipo,
            $idCliente,
            $idEstado,
            $user->getId()
        );
    }
}
