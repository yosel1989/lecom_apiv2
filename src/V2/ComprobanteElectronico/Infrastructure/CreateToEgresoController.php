<?php

namespace Src\V2\ComprobanteElectronico\Infrastructure;

use App\Enums\EnumTipoComprobante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\ComprobanteElectronico\Application\CreateToBoletoUseCase;
use Src\V2\ComprobanteElectronico\Domain\ComprobanteElectronico;
use Src\V2\ComprobanteElectronico\Infrastructure\Repositories\EloquentComprobanteElectronicoRepository;
use Src\V2\Egreso\Domain\Egreso;

final class CreateToEgresoController
{
    private EloquentComprobanteElectronicoRepository $repository;

    public function __construct( EloquentComprobanteElectronicoRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request, Egreso $boleto ): ComprobanteElectronico
    {
        $user = Auth::user();

        $idTipoDocumento = EnumTipoComprobante::TicketEgreso;
        $numeroDocumento = $request->input('numeroDocumentoEntidad');
        $nombre = $request->input('nombreEntidad');
        $direccion = $request->input('direccionEntidad');

        $useCase = new CreateToBoletoUseCase( $this->repository );
        return $useCase->__invoke(
            $idTipoDocumento,
            $numeroDocumento,
            $nombre,
            $direccion,
            $user->getId(),
            $boleto
        );
    }
}
