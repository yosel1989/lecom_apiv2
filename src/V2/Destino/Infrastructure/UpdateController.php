<?php

namespace Src\V2\Destino\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Destino\Application\UpdateUseCase;
use Src\V2\Destino\Infrastructure\Repositories\EloquentDestinoRepository;

final class UpdateController
{
    private EloquentDestinoRepository $repository;

    public function __construct( EloquentDestinoRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $idDestino     = $request->id;
        $nombre          = $request->input('nombre');
        $precioBase      = $request->input('precioBase');
        $idEstado   = $request->input('idEstado');

        $useCase = new UpdateUseCase( $this->repository );
        $useCase->__invoke(
            $idDestino,
            $nombre,
            $precioBase,
            $idEstado,
            $user->getId()
        );
    }
}
