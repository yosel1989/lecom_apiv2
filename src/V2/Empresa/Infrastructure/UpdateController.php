<?php

namespace Src\V2\Empresa\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Empresa\Application\UpdateUseCase;
use Src\V2\Empresa\Infrastructure\Repositories\EloquentEmpresaRepository;

final class UpdateController
{
    private EloquentEmpresaRepository $repository;

    public function __construct( EloquentEmpresaRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $idEmpresa     = $request->id;
        $nombre          = $request->input('nombre');
        $ruc          = $request->input('ruc');
        $direccion          = $request->input('direccion');
        $idUbigeo          = $request->input('idUbigeo');
        $idEstado   = $request->input('idEstado');

        $useCase = new UpdateUseCase( $this->repository );
        $useCase->__invoke(
            $idEmpresa,
            $nombre,
            $ruc,
            $direccion,
            $idUbigeo,
            $idEstado,
            $user->getId()
        );
    }
}
