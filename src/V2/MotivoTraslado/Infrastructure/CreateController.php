<?php

namespace Src\V2\MotivoTraslado\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\MotivoTraslado\Application\CreateUseCase;
use Src\V2\MotivoTraslado\Infrastructure\Repositories\EloquentMotivoTrasladoRepository;

final class CreateController
{
    private EloquentMotivoTrasladoRepository $repository;

    public function __construct( EloquentMotivoTrasladoRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request, string $id ): void
    {
        $user = Auth::user();
        $nombre             = $request->input('nombre');
        $icono             = $request->input('icono');
        $codigo          = $request->input('codigo');
        $idEstado           = $request->input('idEstado');

        $useCase = new CreateUseCase( $this->repository );
        $useCase->__invoke(
            $nombre,
            $icono,
            $codigo,
            $idEstado,
            $user->getId()
        );
    }
}
