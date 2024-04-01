<?php

namespace Src\V2\ComprobanteElectronico\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\BoletoInterprovincial\Domain\BoletoInterprovincialOficial;
use Src\V2\ComprobanteElectronico\Application\CreateToBoletoUseCase;
use Src\V2\ComprobanteElectronico\Domain\ComprobanteElectronico;
use Src\V2\ComprobanteElectronico\Infrastructure\Repositories\EloquentComprobanteElectronicoRepository;

final class CreateToBoletoController
{
    private EloquentComprobanteElectronicoRepository $repository;

    public function __construct( EloquentComprobanteElectronicoRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request, BoletoInterprovincialOficial $boleto ): ComprobanteElectronico
    {
        $user = Auth::user();

        $idTipoDocumento = $request->input('idTipoDocumentoEntidad');
        $editarEntidad = $request->input('editarEntidad');
        $numeroDocumento = $request->input('numeroDocumentoEntidad');
        $nombre = $request->input('nombreEntidad');
        $direccion = $request->input('direccionEntidad');

        $useCase = new CreateToBoletoUseCase( $this->repository );
        return $useCase->__invoke(
            $idTipoDocumento,
            $editarEntidad,
            $numeroDocumento,
            $nombre,
            $direccion,
            $user->getId(),
            $boleto
        );
    }
}
