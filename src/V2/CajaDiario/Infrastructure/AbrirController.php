<?php

namespace Src\V2\CajaDiario\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\CajaDiario\Application\AbrirUseCase;
use Src\V2\CajaDiario\Infrastructure\Repositories\EloquentCajaDiarioRepository;

final class AbrirController
{
    private EloquentCajaDiarioRepository $repository;

    public function __construct( EloquentCajaDiarioRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): string
    {
        $user = Auth::user();
        $idCaja = $request->input('idCaja');
        $idCliente = $request->input('idCliente');
        $monto = $request->input('monto');

        $useCase = new AbrirUseCase( $this->repository );
        return $useCase->__invoke(
            $idCaja,
            $idCliente,
            $monto,
            $user->getId()
        );
    }
}
