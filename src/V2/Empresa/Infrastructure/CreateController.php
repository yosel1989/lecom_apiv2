<?php

namespace Src\V2\Empresa\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Empresa\Application\CreateUseCase;
use Src\V2\Empresa\Infrastructure\Repositories\EloquentEmpresaRepository;

final class CreateController
{
    private EloquentEmpresaRepository $repository;

    public function __construct( EloquentEmpresaRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request, string $id ): void
    {
        $user = Auth::user();
        $nombre             = $request->input('nombre');
        $ruc             = $request->input('ruc');
        $direccion             = $request->input('direccion');
        $idCliente          = $request->input('idCliente');
        $idUbigeo          = $request->input('idUbigeo');
        $idEstado           = $request->input('idEstado');

        $useCase = new CreateUseCase( $this->repository );
        $useCase->__invoke(
            $nombre,
            $ruc,
            $direccion,
            $idUbigeo,
            $idCliente,
            $idEstado,
            $user->getId()
        );
    }
}
