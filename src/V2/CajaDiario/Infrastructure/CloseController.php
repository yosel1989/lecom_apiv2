<?php

namespace Src\V2\CajaDiario\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\CajaDiario\Application\CloseUseCase;
use Src\V2\CajaDiario\Infrastructure\Repositories\EloquentCajaDiarioRepository;

final class CloseController
{
    private EloquentCajaDiarioRepository $repository;

    public function __construct( EloquentCajaDiarioRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $idCajaDiario     = $request->input('idCajaDiario');
        $idCaja     = $request->input('idCaja');
        $idRuta          = $request->input('idRuta');
        $idCliente          = $request->input('idCliente');
        $montoFinal     = $request->input('montoFinal');
        $fechaCierre     = $request->input('fecha');

        $useCase = new CloseUseCase( $this->repository );
        $useCase->__invoke(
            $idCajaDiario,
            $idCaja,
            $idRuta,
            $idCliente,
            $montoFinal,
            $fechaCierre,
            $user->getId()
        );
    }
}
