<?php


namespace Src\V2\Egreso\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Egreso\Application\GetCollectionByClienteUseCase;
use Src\V2\Egreso\Domain\EgresoList;
use Src\V2\Egreso\Infrastructure\Repositories\EloquentEgresoRepository;

final class GetCollectionByClienteController
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
    public function __invoke( Request $request ): EgresoList
    {
        $idClient = $request->id;
        $getVehicleCollectionByClientUseCase = new GetCollectionByClienteUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($idClient);
    }

}
