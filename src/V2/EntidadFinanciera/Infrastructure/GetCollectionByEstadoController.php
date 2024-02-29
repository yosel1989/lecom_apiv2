<?php

namespace Src\V2\EntidadFinanciera\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\EntidadFinanciera\Application\GetListUseCase;
use Src\V2\EntidadFinanciera\Domain\EntidadFinancieraList;
use Src\V2\EntidadFinanciera\Infrastructure\Repositories\EloquentEntidadFinancieraRepository;

final class GetCollectionByEstadoController
{
    private EloquentEntidadFinancieraRepository $repository;

    public function __construct(EloquentEntidadFinancieraRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): EntidadFinancieraList
    {
        $_idEstado = $request->idEstado;
        $getVehicleCollectionByClientUseCase = new GetListUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($_idEstado);
    }

}
