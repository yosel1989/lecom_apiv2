<?php

namespace Src\V2\Pos\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Pos\Application\UpdateUseCase;
use Src\V2\Pos\Infrastructure\Repositories\EloquentPosRepository;

final class UpdateController
{
    private EloquentPosRepository $repository;

    public function __construct( EloquentPosRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $idPos     = $request->id;
        $nombre          = $request->input('nombre');
        $imei          = $request->input('imei');
        $idSede          = $request->input('idSede');
        $idEstado   = $request->input('idEstado');

        $useCase = new UpdateUseCase( $this->repository );
        $useCase->__invoke(
            $idPos,
            $nombre,
            $imei,
            $idSede,
            $idEstado,
            $user->getId()
        );
    }
}
