<?php

namespace Src\V2\Caja\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Caja\Application\CreateUseCase;
use Src\V2\Caja\Infrastructure\Repositories\EloquentCajaRepository;

final class CreateController
{
    private EloquentCajaRepository $repository;

    public function __construct( EloquentCajaRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request, string $id ): void
    {
        $user = Auth::user();
        $nombre             = $request->input('nombre');
        $idSede             = $request->input('idSede');
        $idPos             = $request->input('idPos');
        $idCliente          = $id;
        $blPuntoVenta           = $request->input('blPuntoVenta');
        $blDespacho           = $request->input('blDespacho');
        $blPrincipal          = $request->input('blPrincipal');
        $idEstado           = $request->input('idEstado');

        $useCase = new CreateUseCase( $this->repository );
        $useCase->__invoke(
            $nombre,
            $idCliente,
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
