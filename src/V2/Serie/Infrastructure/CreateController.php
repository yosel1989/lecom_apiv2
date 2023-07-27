<?php

namespace Src\V2\Serie\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Serie\Application\CreateUseCase;
use Src\V2\Serie\Infrastructure\Repositories\EloquentSerieRepository;

final class CreateController
{
    private EloquentSerieRepository $repository;

    public function __construct( EloquentSerieRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request, string $id ): void
    {
        $user = Auth::user();
        $nombre             = $request->input('nombre');
        $idTipo             = $request->input('idTipoSerie');
        $idSede             = $request->input('idSede');
        $idCliente          = $id;
        $idEstado           = $request->input('idEstado');

        $useCase = new CreateUseCase( $this->repository );
        $useCase->__invoke(
            $nombre,
            $idCliente,
            $idSede,
            $idTipo,
            $idEstado,
            $user->getId()
        );
    }
}
