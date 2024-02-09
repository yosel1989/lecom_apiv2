<?php

namespace Src\V2\LiquidacionEstadoMotivo\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\LiquidacionEstadoMotivo\Application\GetCollectionByEstadoUseCase;
use Src\V2\LiquidacionEstadoMotivo\Domain\LiquidacionEstadoMotivoList;
use Src\V2\LiquidacionEstadoMotivo\Infrastructure\Repositories\EloquentLiquidacionEstadoMotivoRepository;

final class GetCollectionByEstadoController
{
    private EloquentLiquidacionEstadoMotivoRepository $repository;

    public function __construct(EloquentLiquidacionEstadoMotivoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): LiquidacionEstadoMotivoList
    {
        $_idEstado = $request->idEstado;
        $getVehicleCollectionByClientUseCase = new GetCollectionByEstadoUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($_idEstado);
    }

}
