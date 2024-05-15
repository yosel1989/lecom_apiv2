<?php

namespace Src\V2\CajaTraslado\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\CajaTraslado\Application\UpdateUseCase;
use Src\V2\CajaTraslado\Infrastructure\Repositories\EloquentCajaTrasladoRepository;

final class UpdateController
{
    private EloquentCajaTrasladoRepository $repository;

    public function __construct( EloquentCajaTrasladoRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $idCajaTraslado     = $request->id;
        $nombre          = $request->input('nombre');
        $idCategoria          = $request->input('idCategoria');
        $precioBase          = $request->input('precioBase');
        $idEstado   = $request->input('idEstado');

        $useCase = new UpdateUseCase( $this->repository );
        $useCase->__invoke(
            $idCajaTraslado,
            $nombre,
            $idCategoria,
            $precioBase,
            $idEstado,
            $user->getId()
        );
    }
}
