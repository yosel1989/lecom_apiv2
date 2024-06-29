<?php

declare(strict_types=1);

namespace Src\V2\Egreso\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Src\V2\Egreso\Application\CreateUseCase;
use Src\V2\Egreso\Domain\Egreso;
use Src\V2\Egreso\Infrastructure\Repositories\EloquentEgresoRepository;

final class CreateController
{
    private EloquentEgresoRepository $repository;

    public function __construct(
        EloquentEgresoRepository $repository,
    )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request): Egreso
    {
        DB::beginTransaction();

        try{
            $Id         = Uuid::uuid4();

            $user = Auth::user();

            $idOrigen          = $request->input('idOrigen');
            $idCliente          = $request->input('idCliente');
            $idTipoComprobante = $request->input('idTipoComprobante');
//            $serie = $request->input('serie');
//            $numero = $request->input('numero');
            $idCategoria           = $request->input('idCategoria');
            $idMedioPago           = $request->input('idMedioPago');
            $idTipo           = $request->input('idTipo');
            $detalle           = $request->input('detalle');
            $idTipoDocumentoEntidad           = $request->input('idTipoDocumentoEntidad');
            $numeroDocumentoEntidad           = $request->input('numeroDocumentoEntidad');
            $nombreEntidad           = $request->input('nombreEntidad');
            $idSede          = $request->input('idSede');
            $monto          = $request->input('monto');
            $idVehiculo          = $request->input('idVehiculo');
            $idPersonal          = $request->input('idPersonal');
            $idCaja          = $request->input('idCaja');
            $idCajaDiario           = $request->input('idCajaDiario');
            $fecha           = $request->input('fecha');

            $useCase = new CreateUseCase( $this->repository );
            $_egreso =$useCase->__invoke(
                $Id->toString(),
                $idOrigen,
                $idCliente,
                $idTipoComprobante,
//                $serie,
//                $numero,
                $idCategoria,
                $idTipo,
                $detalle,
                $idTipoDocumentoEntidad,
                $numeroDocumentoEntidad,
                $nombreEntidad,
                $idSede,
                $monto,
                $idMedioPago,
                $idVehiculo,
                $idPersonal,
                $idCaja,
                $idCajaDiario,
                $fecha,
                $user->getId()
            );

            DB::commit();

            return $_egreso;
        }catch(\Exception $e){
            DB::rollBack();
            throw new \InvalidArgumentException($e->getMessage());
        }

    }
}
