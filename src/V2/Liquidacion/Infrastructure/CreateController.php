<?php

declare(strict_types=1);

namespace Src\V2\Liquidacion\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Src\V2\Liquidacion\Application\CreateUseCase;
use Src\V2\Liquidacion\Application\DeleteUseCase;
use Src\V2\Liquidacion\Infrastructure\Repositories\EloquentLiquidacionRepository;
use Src\V2\LiquidacionDetalle\Application\DeleteByLiquidacionUseCase;
use Src\V2\LiquidacionDetalle\Infrastructure\Repositories\EloquentLiquidacionDetalleRepository;

final class CreateController
{
    private EloquentLiquidacionRepository $repository;
    private EloquentLiquidacionDetalleRepository $detalleRepository;

    public function __construct( EloquentLiquidacionRepository $repository, EloquentLiquidacionDetalleRepository $detalleRepository )
    {
        $this->repository = $repository;
        $this->detalleRepository = $detalleRepository;
    }

    public function __invoke( Request $request): void
    {
        $Id         = Uuid::uuid4();

        $user = Auth::user();
        $idCliente          = $request->input('idCliente');
        $idSede          = $request->input('idSede');
        $idVehiculo          = $request->input('idVehiculo');
        $idPersonal          = $request->input('idPersonal');
        $total          = $request->input('total');
        $idCaja          = $request->input('idCaja');
        $idCajaDiario           = $request->input('idCajaDiario');


        $detalle           = $request->input('detalle');

        $useCase = new CreateUseCase( $this->repository );
        $useCase->__invoke(
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

        $createDetalleUseCase = new \Src\V2\LiquidacionDetalle\Application\CreateUseCase($this->detalleRepository);

        try {
            foreach ($detalle as $det) {
                $d = (object) $det;
                $createDetalleUseCase->__invoke(
                    $Id->toString(),
                    $idCliente,
                    $d->idTipoLiquidacion,
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

            $deleteDetalleByLiquidacionUseCase = new DeleteByLiquidacionUseCase($this->detalleRepository);
            $deleteDetalleByLiquidacionUseCase->__invoke($Id->toString());

            throw new \InvalidArgumentException($e->getMessage());
        }


    }
}
