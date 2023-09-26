<?php

namespace Src\V2\ComprobanteSerie\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\ComprobanteSerie\Application\UpdateUseCase;
use Src\V2\ComprobanteSerie\Infrastructure\Repositories\EloquentComprobanteSerieRepository;

final class UpdateController
{
    private EloquentComprobanteSerieRepository $repository;

    public function __construct( EloquentComprobanteSerieRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $id     = $request->id;
        $user = Auth::user();
        $nombre             = $request->input('nombre');
        $idTipoComprobante  = $request->input('idTipoComprobante');
        $idCliente  = $request->input('idCliente');
        $idSede  = $request->input('idSede');
        $idEstado           = $request->input('idEstado');

        $useCase = new UpdateUseCase( $this->repository );
        $useCase->__invoke(
            $id,
            $nombre,
            $idTipoComprobante,
            $idCliente,
            $idSede,
            $idEstado,
            $user->getId()
        );
    }
}
