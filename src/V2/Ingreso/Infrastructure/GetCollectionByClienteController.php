<?php


namespace Src\V2\Ingreso\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Ingreso\Application\GetCollectionByClienteUseCase;
use Src\V2\Ingreso\Domain\IngresoList;
use Src\V2\Ingreso\Infrastructure\Repositories\EloquentIngresoRepository;

final class GetCollectionByClienteController
{
    private EloquentIngresoRepository $repository;

    public function __construct(EloquentIngresoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): IngresoList
    {
        $idClient = $request->id;
        $getVehicleCollectionByClientUseCase = new GetCollectionByClienteUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($idClient);
    }

}
