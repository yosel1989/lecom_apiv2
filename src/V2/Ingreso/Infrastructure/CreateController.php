<?php

declare(strict_types=1);

namespace Src\V2\Ingreso\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Src\V2\Ingreso\Application\CreateUseCase;
use Src\V2\Ingreso\Domain\Ingreso;
use Src\V2\Ingreso\Infrastructure\Repositories\EloquentIngresoRepository;

final class CreateController
{
    private EloquentIngresoRepository $repository;

    public function __construct(
        EloquentIngresoRepository $repository,
    )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request): Ingreso
    {
        DB::beginTransaction();

        try{
            $Id = Uuid::uuid4();

            $user = Auth::user();
            $idCliente = $request->input('idCliente');
            $idSede = $request->input('idSede');
            $idTipoComprobante = $request->input('idTipoComprobante');
            $idTipoIngreso = $request->input('idTipoIngreso');
            $detalle = $request->input('detalle');
            $idTipoDocumentoEntidad = $request->input('idTipoDocumentoEntidad');
            $numeroDocumentoEntidad = $request->input('numeroDocumentoEntidad');
            $nombreEntidad = $request->input('nombreEntidad');
            $importe = $request->input('importe');
            $idCaja = $request->input('idCaja');
            $idCajaDiario = $request->input('idCajaDiario');
            $contabilizado = $request->input('contabilizado');
            $aprobado = $request->input('aprobado');
            $idMedioPago = $request->input('idMedioPago');
            $numeroOperacion = $request->input('numeroOperacion');
            $idEntidadFinanciera = $request->input('idEntidadFinanciera');

            $useCase = new CreateUseCase( $this->repository );
            $_ingreso = $useCase->__invoke(
                $Id->toString(),
                $idCliente,
                $idSede,
                $idTipoComprobante,
                $idTipoIngreso,
                $detalle,
                $idTipoDocumentoEntidad,
                $numeroDocumentoEntidad,
                $nombreEntidad,
                $importe,
                $idCaja,
                $idCajaDiario,
                $contabilizado,
                $aprobado,
                $idMedioPago,
                $numeroOperacion,
                $idEntidadFinanciera,
                $user->getId()
            );

            DB::commit();

            return $_ingreso;
        }catch(\Exception $e){
            DB::rollBack();
            throw new \InvalidArgumentException($e->getMessage());
        }

    }
}
