<?php


namespace Src\V2\BoletoInterprovincial\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        DB::beginTransaction();

        try {
            $id   = \Ramsey\Uuid\Uuid::uuid4();
            $user = Auth::user();

            $idCliente = $request->input('idCliente');
            $idSede = $request->input('idSede');
            $idCaja = $request->input('idCaja');
            $idCajaDiario = $request->input('idCajaDiario');
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
            $idMedioPago = $request->input('idMedioPago');
            $obsequio = $request->input('obsequio');

            $idEmpresa = $request->input('idEmpresa');
            $idTipoComprobante = $request->input('idTipoComprobante');
            $idSerie = $request->input('idSerie');
            $editarEntidad = $request->input('editarEntidad');
            $idTipoDocumentoEntidad = $request->input('idTipoDocumentoEntidad'); //null
            $numeroDocumentoEntidad = $request->input('numeroDocumento');
            $nombreEntidad = $request->input('nombreEntidad');
            $direccionEntidad = $request->input('direccionEntidad');

            $idUsuarioRegistro = $user->getId();

            $useCase = new PuntoVentaUseCase($this->repository);

            $output = $useCase->__invoke(
                $id,
                $idCliente,
                $idSede,
                $idCaja,
                $idCajaDiario,
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
                $idMedioPago,
                $obsequio,

                $idEmpresa,
                $idTipoComprobante,
                $idSerie,
                $editarEntidad,
                $idTipoDocumentoEntidad,
                $numeroDocumentoEntidad,
                $nombreEntidad,
                $direccionEntidad,

                $idUsuarioRegistro,
            );

            DB::commit();

            return $output;

        }catch(\Exception $e){
            DB::rollBack();
            throw new \InvalidArgumentException($e->getMessage());
        }
    }

}
