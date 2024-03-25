<?php

namespace Src\V2\CajaDiario\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Caja\Domain\CajaSede;
use Src\V2\CajaDiario\Application\MontoActualUseCase;
use Src\V2\CajaDiario\Infrastructure\Repositories\EloquentCajaDiarioRepository;

final class MontoActualController
{
    private EloquentCajaDiarioRepository $repository;

    public function __construct( EloquentCajaDiarioRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): CajaSede
    {
        $user = Auth::user();
        $idCaja = $request->idCaja;
        $idCliente = $request->idCliente;

        $useCase = new MontoActualUseCase( $this->repository );
        return $useCase->__invoke(
            $idCaja,
            $idCliente
        );
    }
}
