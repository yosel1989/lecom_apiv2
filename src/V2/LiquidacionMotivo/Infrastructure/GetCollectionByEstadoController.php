<?php

namespace Src\V2\LiquidacionMotivo\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\LiquidacionMotivo\Application\GetCollectionByEstadoUseCase;
use Src\V2\LiquidacionMotivo\Domain\LiquidacionMotivoList;
use Src\V2\LiquidacionMotivo\Infrastructure\Repositories\EloquentLiquidacionRepository;

final class GetCollectionByEstadoController
{
    private EloquentLiquidacionRepository $repository;

    public function __construct(EloquentLiquidacionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): LiquidacionMotivoList
    {
        $_idEstado = $request->idEstado;
        $getVehicleCollectionByClientUseCase = new GetCollectionByEstadoUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($_idEstado);
    }

}
