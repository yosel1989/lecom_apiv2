<?php

namespace Src\V2\TipoPersonal\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\TipoPersonal\Application\CreateUseCase;
use Src\V2\TipoPersonal\Infrastructure\Repositories\EloquentTipoPersonalRepository;

final class CreateController
{
    private EloquentTipoPersonalRepository $repository;

    public function __construct( EloquentTipoPersonalRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request): void
    {
        $user = Auth::user();
        $idCliente             = $request->input('idCliente');
        $nombre             = $request->input('nombre');
        $idEstado           = $request->input('idEstado');

        $useCase = new CreateUseCase( $this->repository );
        $useCase->__invoke(
            $idCliente,
            $nombre,
            $idEstado,
            $user->getId()
        );
    }
}
