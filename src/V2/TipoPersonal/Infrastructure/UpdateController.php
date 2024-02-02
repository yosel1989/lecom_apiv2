<?php

namespace Src\V2\TipoPersonal\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\TipoPersonal\Application\UpdateUseCase;
use Src\V2\TipoPersonal\Infrastructure\Repositories\EloquentTipoPersonalRepository;

final class UpdateController
{
    private EloquentTipoPersonalRepository $repository;

    public function __construct( EloquentTipoPersonalRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $id     = $request->id;
        $idCliente             = $request->input('idCliente');
        $nombre             = $request->input('nombre');
        $idEstado           = $request->input('idEstado');

        $useCase = new UpdateUseCase( $this->repository );
        $useCase->__invoke(
            $id,
            $idCliente,
            $nombre,
            $idEstado,
            $user->getId()
        );
    }
}
