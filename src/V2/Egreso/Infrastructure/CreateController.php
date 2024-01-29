<?php

namespace Src\V2\Egreso\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Egreso\Application\CreateUseCase;
use Src\V2\Egreso\Infrastructure\Repositories\EloquentEgresoRepository;

final class CreateController
{
    private EloquentEgresoRepository $repository;

    public function __construct( EloquentEgresoRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request): void
    {
        $user = Auth::user();
        $idEgreso             = $request->input('idEgreso');
        $idCliente          = $request->input('idCliente');
        $idEgresoTipo          = $request->input('idEgresoTipo');
        $fecha          = $request->input('fecha');
        $detalle           = $request->input('detalle');
        $total           = $request->input('total');

        $useCase = new CreateUseCase( $this->repository );
        $useCase->__invoke(
            $idEgreso,
            $idCliente,
            $idEgresoTipo,
            $fecha,
            $detalle,
            $total,
            $user->getId()
        );
    }
}
