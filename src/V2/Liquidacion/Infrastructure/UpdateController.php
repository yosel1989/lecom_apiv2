<?php

namespace Src\V2\Liquidacion\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Liquidacion\Application\UpdateUseCase;
use Src\V2\Liquidacion\Infrastructure\Repositories\EloquentLiquidacionRepository;

final class UpdateController
{
    private EloquentLiquidacionRepository $repository;

    public function __construct( EloquentLiquidacionRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $idLiquidacion     = $request->id;
        $nombre          = $request->input('nombre');
        $idCategoria          = $request->input('idCategoria');
        $precioBase          = $request->input('precioBase');
        $idEstado   = $request->input('idEstado');

        $useCase = new UpdateUseCase( $this->repository );
        $useCase->__invoke(
            $idLiquidacion,
            $nombre,
            $idCategoria,
            $precioBase,
            $idEstado,
            $user->getId()
        );
    }
}
