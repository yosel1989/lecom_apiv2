<?php

namespace Src\V2\CajaDiario\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\Core\Domain\ValueObjects\Id;
use Src\V2\CajaDiario\Application\OpenUseCase;
use Src\V2\CajaDiario\Infrastructure\Repositories\EloquentCajaDiarioRepository;

final class OpenController
{
    private EloquentCajaDiarioRepository $repository;

    public function __construct( EloquentCajaDiarioRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): Id
    {
        $user = Auth::user();
        $idCaja     = $request->input('idCaja');
        $idRuta          = $request->input('idRuta');
        $idCliente          = $request->input('idCliente');
        $montoInicial     = $request->input('montoInicial');
        $fechaApertura     = $request->input('fecha');

        $useCase = new OpenUseCase( $this->repository );
        return $useCase->__invoke(
            $idCaja,
            $idRuta,
            $idCliente,
            $montoInicial,
            $fechaApertura,
            $user->getId()
        );
    }
}
