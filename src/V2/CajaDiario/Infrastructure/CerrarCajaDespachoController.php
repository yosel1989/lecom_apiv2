<?php

namespace Src\V2\CajaDiario\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\CajaDiario\Application\CerrarCajaDespachoUseCase;
use Src\V2\CajaDiario\Infrastructure\Repositories\EloquentCajaDiarioRepository;

final class CerrarCajaDespachoController
{
    private EloquentCajaDiarioRepository $repository;

    public function __construct( EloquentCajaDiarioRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $idCaja     = $request->input('idCaja');
        $idCajaDiario     = $request->input('idCajaDiario');
        $idCliente          = $request->input('idCliente');
        $monto    = $request->input('monto');

        $useCase = new CerrarCajaDespachoUseCase( $this->repository );
        $useCase->__invoke(
            $idCaja,
            $idCajaDiario,
            $idCliente,
            $monto,
            $user->getId()
        );
    }
}
