<?php

declare(strict_types=1);

namespace Src\V2\Ingreso\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Src\V2\Ingreso\Application\CreateUseCase;
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

    public function __invoke( Request $request): void
    {
        DB::beginTransaction();

        try{
            $Id         = Uuid::uuid4();

            $user = Auth::user();
            $idCliente          = $request->input('idCliente');
            $idSede          = $request->input('idSede');
            $idVehiculo          = $request->input('idVehiculo');
            $idPersonal          = $request->input('idPersonal');
            $total          = $request->input('total');
            $idCaja          = $request->input('idCaja');
            $idCajaDiario           = $request->input('idCajaDiario');

            $idTipoDocumentoEntidad           = $request->input('idTipoDocumentoEntidad');
            $numeroDocumentoEntidad           = $request->input('numeroDocumentoEntidad');
            $nombreEntidad           = $request->input('nombreEntidad');

            $detalle           = $request->input('detalle');

            $useCase = new CreateUseCase( $this->repository );
            $_ingreso =$useCase->__invoke(
                $Id->toString(),
                $idCliente,
                $idSede,
                $idVehiculo,
                $idPersonal,
                $total,
                $idCaja,
                $idCajaDiario,
                $user->getId()
            );
            $_ingreso->setDetalle(new IngresoDetalleList());

            $createDetalleUseCase = new \Src\V2\IngresoDetalle\Application\CreateUseCase($this->detalleRepository);

            foreach ($detalle as $det) {
                $IdDetalle         = Uuid::uuid4();
                $d = (object) $det;
                $detalle = $createDetalleUseCase->__invoke(
                    $IdDetalle->toString(),
                    $Id->toString(),
                    $idCliente,
                    $d->idTipoIngreso,
                    $d->detalle,
                    $d->fecha,
                    $d->importe,
                    $d->numeroDocumento,
                    $user->getId()
                );
                $_ingreso->getDetalle()->add($detalle);
            }

            //

            $comprobanteElectronicoUseCase = new CreateToIngresoUseCase($this->comprobanteElectronicoRepository);
            $comprobanteElectronicoUseCase->__invoke(
                $idTipoDocumentoEntidad,
                $numeroDocumentoEntidad,
                $nombreEntidad,
                null,
                $user->getId(),
                $_ingreso,
            );


            DB::commit();

            /*try {
                foreach ($detalle as $det) {
                    $d = (object) $det;
                    $createDetalleUseCase->__invoke(
                        $Id->toString(),
                        $idCliente,
                        $d->idTipoIngreso,
                        $d->detalle,
                        $d->fecha,
                        $d->importe,
                        $d->numeroDocumento,
                        $user->getId()
                    );
                }
            }catch(\Exception $e){
                $deleteUseCase = new DeleteUseCase($this->repository);
                $deleteUseCase->__invoke($Id->toString());

                $deleteDetalleByIngresoUseCase = new DeleteByIngresoUseCase($this->detalleRepository);
                $deleteDetalleByIngresoUseCase->__invoke($Id->toString());

                throw new \InvalidArgumentException($e->getMessage());
            }*/
        }catch(\Exception $e){
            DB::rollBack();
            throw new \InvalidArgumentException($e->getMessage());
        }

    }
}
