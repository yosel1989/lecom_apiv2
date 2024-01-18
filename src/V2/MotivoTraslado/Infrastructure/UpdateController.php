<?php

namespace Src\V2\MotivoTraslado\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\MotivoTraslado\Application\UpdateUseCase;
use Src\V2\MotivoTraslado\Infrastructure\Repositories\EloquentMotivoTrasladoRepository;

final class UpdateController
{
    private EloquentMotivoTrasladoRepository $repository;

    public function __construct( EloquentMotivoTrasladoRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $idMotivoTraslado     = $request->id;
        $nombre          = $request->input('nombre');
        $icono          = $request->input('icono');
        $codigo          = $request->input('codigo');
        $idEstado   = $request->input('idEstado');

        $useCase = new UpdateUseCase( $this->repository );
        $useCase->__invoke(
            $idMotivoTraslado,
            $nombre,
            $icono,
            $codigo,
            $idEstado,
            $user->getId()
        );
    }
}
