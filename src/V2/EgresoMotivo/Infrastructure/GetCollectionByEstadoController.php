<?php

namespace Src\V2\EgresoMotivo\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\EgresoMotivo\Application\GetCollectionByEstadoUseCase;
use Src\V2\EgresoMotivo\Domain\EgresoMotivoList;
use Src\V2\EgresoMotivo\Infrastructure\Repositories\EloquentEgresoRepository;

final class GetCollectionByEstadoController
{
    private EloquentEgresoRepository $repository;

    public function __construct(EloquentEgresoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): EgresoMotivoList
    {
        $_idEstado = $request->idEstado;
        $getVehicleCollectionByClientUseCase = new GetCollectionByEstadoUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($_idEstado);
    }

}
