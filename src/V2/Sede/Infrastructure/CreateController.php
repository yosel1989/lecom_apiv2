<?php

namespace Src\V2\Sede\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Sede\Application\CreateUseCase;
use Src\V2\Sede\Infrastructure\Repositories\EloquentSedeRepository;

final class CreateController
{
    private EloquentSedeRepository $repository;

    public function __construct( EloquentSedeRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request, string $id ): void
    {
        $user = Auth::user();
        $nombre             = $request->input('nombre');
        $direccion             = $request->input('direccion');
        $idCliente          = $request->input('idCliente');
        $idEstado           = $request->input('idEstado');

        $useCase = new CreateUseCase( $this->repository );
        $useCase->__invoke(
            $nombre,
            $direccion,
            $idCliente,
            $idEstado,
            $user->getId()
        );
    }
}
