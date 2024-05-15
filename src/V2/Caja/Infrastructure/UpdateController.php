<?php

namespace Src\V2\Caja\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Caja\Application\UpdateUseCase;
use Src\V2\Caja\Infrastructure\Repositories\EloquentCajaRepository;

final class UpdateController
{
    private EloquentCajaRepository $repository;

    public function __construct( EloquentCajaRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $idCaja     = $request->id;
        $nombre          = $request->input('nombre');
        $idSede          = $request->input('idSede');
        $blPuntoVenta          = $request->input('blPuntoVenta');
        $blDespacho          = $request->input('blDespacho');
        $blPrincipal          = $request->input('blPrincipal');
        $idPos          = $request->input('idPos');
        $idEstado   = $request->input('idEstado');

        $useCase = new UpdateUseCase( $this->repository );
        $useCase->__invoke(
            $idCaja,
            $nombre,
            $idSede,
            $idPos,
            $blPuntoVenta,
            $blDespacho,
            $blPrincipal,
            $idEstado,
            $user->getId()
        );
    }
}
