<?php

namespace Src\V2\Destino\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Destino\Application\CreateUseCase;
use Src\V2\Destino\Infrastructure\Repositories\EloquentDestinoRepository;

final class CreateController
{
    private EloquentDestinoRepository $repository;

    public function __construct( EloquentDestinoRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request, string $id ): void
    {
        $user = Auth::user();
        $nombre             = $request->input('nombre');
        $precioBase         = $request->input('precioBase');
        $idCliente          = $id;
        $idEstado           = $request->input('idEstado');

        $useCase = new CreateUseCase( $this->repository );
        $useCase->__invoke(
            $nombre,
            $precioBase,
            $idCliente,
            $idEstado,
            $user->getId()
        );
    }
}
