<?php

namespace Src\V2\Pos\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Pos\Application\CreateUseCase;
use Src\V2\Pos\Infrastructure\Repositories\EloquentPosRepository;

final class CreateController
{
    private EloquentPosRepository $repository;

    public function __construct( EloquentPosRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request, string $id ): void
    {
        $user = Auth::user();
        $nombre             = $request->input('nombre');
        $imei             = $request->input('imei');
        $idSede             = $request->input('idSede');
        $idCliente          = $id;
        $idEstado           = $request->input('idEstado');

        $useCase = new CreateUseCase( $this->repository );
        $useCase->__invoke(
            $nombre,
            $imei,
            $idCliente,
            $idSede,
            $idEstado,
            $user->getId()
        );
    }
}
