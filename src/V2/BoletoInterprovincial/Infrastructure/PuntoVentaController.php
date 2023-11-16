<?php


namespace Src\V2\BoletoInterprovincial\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\BoletoInterprovincial\Application\PuntoVentaUseCase;
use Src\V2\BoletoInterprovincial\Domain\BoletoInterprovincialOficial;
use Src\V2\BoletoInterprovincial\Infrastructure\Repositories\EloquentBoletoInterprovincialRepository;

final class PuntoVentaController
{
    private EloquentBoletoInterprovincialRepository $repository;

    public function __construct(EloquentBoletoInterprovincialRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return BoletoInterprovincialOficial
     */
    public function __invoke( Request $request ): BoletoInterprovincialOficial
    {
        $id   = \Ramsey\Uuid\Uuid::uuid4();
        $user = Auth::user();

        $idCliente = $request->input('idCliente');
        $idSede = $request->input('idSede');
        $idCaja = $request->input('idCaja');
        $idTipoDocumento = $request->input('idTipoDocumento');
        $numeroDocumento = $request->input('numeroDocumento');
        $nombres = $request->input('nombres');
        $apellidos = $request->input('apellidos');
        $menorEdad = $request->input('menorEdad');


        $idVehiculo = $request->input('idVehiculo'); //null
        $idAsiento = $request->input('numeroAsiento'); //null
        $fechaPartida = $request->input('fechaPartida'); // null
        $horaPartida = $request->input('horaSalida'); //null
        $idRuta = $request->input('idRuta');
        $idBoletoPrecio = $request->input('idBoletoPrecio');
        $precio = $request->input('precio');
        $idTipoMoneda = $request->input('idTipoMoneda');
        $idFormaPago = $request->input('idFormaPago');
        $obsequio = $request->input('obsequio');

        $idTipoComprobante = $request->input('idTipoComprobante');
        $idTipoDocumentoEntidad = $request->input('idTipoDocumentoEntidad'); //null
        $numeroDocumentoEntidad = $request->input('numeroDocumento');
        $nombreEntidad = $request->input('nombreEntidad');
        $direccionEntidad = $request->input('direccionEntidad');

        $idUsuarioRegistro = $user->getId();

        $useCase = new PuntoVentaUseCase($this->repository);
        return $useCase->__invoke(
            $id,
            $idCliente,
            $idSede,
            $idCaja,
            $idTipoDocumento,
            $numeroDocumento,
            $nombres,
            $apellidos,
            $menorEdad,


            $idVehiculo,
            $idAsiento,
            $fechaPartida,
            $horaPartida,
            $idRuta,
            $idBoletoPrecio,
            $precio,
            $idTipoMoneda,
            $idFormaPago,
            $obsequio,

            $idTipoComprobante,
            $idTipoDocumentoEntidad,
            $numeroDocumentoEntidad,
            $nombreEntidad,
            $direccionEntidad,

            $idUsuarioRegistro,
        );
    }

}
