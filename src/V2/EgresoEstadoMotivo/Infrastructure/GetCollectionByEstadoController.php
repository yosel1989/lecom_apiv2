<?php

namespace Src\V2\EgresoEstadoMotivo\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\EgresoEstadoMotivo\Application\GetCollectionByEstadoUseCase;
use Src\V2\EgresoEstadoMotivo\Domain\EgresoEstadoMotivoList;
use Src\V2\EgresoEstadoMotivo\Infrastructure\Repositories\EloquentEgresoEstadoMotivoRepository;

final class GetCollectionByEstadoController
{
    private EloquentEgresoEstadoMotivoRepository $repository;

    public function __construct(EloquentEgresoEstadoMotivoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): EgresoEstadoMotivoList
    {
        $_idEstado = $request->idEstado;
        $useCase = new GetCollectionByEstadoUseCase($this->repository);
        return $useCase->__invoke($_idEstado);
    }

}
