<?php

namespace Src\V2\CajaDiario\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\CajaDiario\Application\ReporteSaldoUseCase;
use Src\V2\CajaDiario\Infrastructure\Repositories\EloquentCajaDiarioRepository;

final class ReporteSaldoController
{
    private EloquentCajaDiarioRepository $repository;

    public function __construct( EloquentCajaDiarioRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): array
    {
        $user = Auth::user();
        $idCliente          = $request->idCliente;
        $fechaInicial     = $request->fechaInicio;
        $fechaFinal     = $request->fechaFin;
        $idCaja     = $request->idCaja == 'null' ? null : $request->idCaja;

        $useCase = new ReporteSaldoUseCase( $this->repository );
        return $useCase->__invoke(
            $idCliente,
            $fechaInicial,
            $fechaFinal,
            $idCaja
        );
    }
}
