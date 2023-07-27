<?php

namespace Src\V2\Serie\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Serie\Application\UpdateUseCase;
use Src\V2\Serie\Infrastructure\Repositories\EloquentSerieRepository;

final class UpdateController
{
    private EloquentSerieRepository $repository;

    public function __construct( EloquentSerieRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $idSerie     = $request->id;
        $nombre          = $request->input('nombre');
        $idTipo             = $request->input('idTipoSerie');
        $idSede          = $request->input('idSede');
        $idEstado   = $request->input('idEstado');

        $useCase = new UpdateUseCase( $this->repository );
        $useCase->__invoke(
            $idSerie,
            $nombre,
            $idSede,
            $idTipo,
            $idEstado,
            $user->getId()
        );
    }
}
