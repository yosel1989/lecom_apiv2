<?php

namespace Src\V2\ComprobanteSerie\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\ComprobanteSerie\Application\CreateUseCase;
use Src\V2\ComprobanteSerie\Infrastructure\Repositories\EloquentComprobanteSerieRepository;

final class CreateController
{
    private EloquentComprobanteSerieRepository $repository;

    public function __construct( EloquentComprobanteSerieRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request, string $id ): void
    {
        $user = Auth::user();
        $nombre             = $request->input('nombre');
        $idCliente          = $id;
        $idTipoComprobante  = $request->input('idTipoComprobante');
        $idSede  = $request->input('idSede');
        $idEstado           = $request->input('idEstado');

        $useCase = new CreateUseCase( $this->repository );
        $useCase->__invoke(
            $nombre,
            $idTipoComprobante,
            $idCliente,
            $idSede,
            $idEstado,
            $user->getId()
        );
    }
}
