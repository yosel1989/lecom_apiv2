<?php

declare(strict_types=1);

namespace Src\V2\Egreso\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Src\V2\ComprobanteElectronico\Infrastructure\Repositories\EloquentComprobanteElectronicoRepository;
use Src\V2\Egreso\Application\CreateUseCase;
use Src\V2\Egreso\Domain\Egreso;
use Src\V2\Egreso\Infrastructure\Repositories\EloquentEgresoRepository;
use Src\V2\EgresoDetalle\Domain\EgresoDetalleList;
use Src\V2\EgresoDetalle\Infrastructure\Repositories\EloquentEgresoDetalleRepository;

final class CreateController
{
    private EloquentEgresoRepository $repository;
    private EloquentEgresoDetalleRepository $detalleRepository;
/*    private EloquentComprobanteElectronicoRepository $comprobanteElectronicoRepository;*/

    public function __construct(
        EloquentEgresoRepository $repository,
        EloquentEgresoDetalleRepository $detalleRepository,
//        EloquentComprobanteElectronicoRepository $comprobanteElectronicoRepository
    )
    {
        $this->repository = $repository;
        $this->detalleRepository = $detalleRepository;
//        $this->comprobanteElectronicoRepository = $comprobanteElectronicoRepository;
    }

    public function __invoke( Request $request): Egreso
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

            $idTipoComprobante = $request->input('idTipoComprobante');
            $idTipoDocumentoEntidad           = $request->input('idTipoDocumentoEntidad');
            $numeroDocumentoEntidad           = $request->input('numeroDocumentoEntidad');
            $nombreEntidad           = $request->input('nombreEntidad');

            $detalle           = $request->input('detalle');

            $useCase = new CreateUseCase( $this->repository );
            $_egreso =$useCase->__invoke(
                $Id->toString(),
                $idCliente,
                $idSede,
                $idTipoComprobante,
                $idTipoDocumentoEntidad,
                $numeroDocumentoEntidad,
                $nombreEntidad,
                $idVehiculo,
                $idPersonal,
                $total,
                $idCaja,
                $idCajaDiario,
                $user->getId()
            );
            $_egreso->setDetalle(new EgresoDetalleList());

            $createDetalleUseCase = new \Src\V2\EgresoDetalle\Application\CreateUseCase($this->detalleRepository);

            foreach ($detalle as $det) {
                $IdDetalle         = Uuid::uuid4();
                $d = (object) $det;
                $detalle = $createDetalleUseCase->__invoke(
                    $IdDetalle->toString(),
                    $Id->toString(),
                    $idCliente,
                    $d->idTipoEgreso,
                    $d->detalle,
                    $d->fecha,
                    $d->importe,
                    $d->numeroDocumento,
                    $user->getId()
                );
                $_egreso->getDetalle()->add($detalle);
            }

            //

//            $comprobanteElectronicoUseCase = new CreateToEgresoUseCase($this->comprobanteElectronicoRepository);
//            $comprobanteElectronicoUseCase->__invoke(
//                $idTipoDocumentoEntidad,
//                $numeroDocumentoEntidad,
//                $nombreEntidad,
//                null,
//                $user->getId(),
//                $_egreso,
//            );


            DB::commit();

            /*try {
                foreach ($detalle as $det) {
                    $d = (object) $det;
                    $createDetalleUseCase->__invoke(
                        $Id->toString(),
                        $idCliente,
                        $d->idTipoEgreso,
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

                $deleteDetalleByEgresoUseCase = new DeleteByEgresoUseCase($this->detalleRepository);
                $deleteDetalleByEgresoUseCase->__invoke($Id->toString());

                throw new \InvalidArgumentException($e->getMessage());
            }*/

            return $_egreso;
        }catch(\Exception $e){
            DB::rollBack();
            throw new \InvalidArgumentException($e->getMessage());
        }

    }
}
