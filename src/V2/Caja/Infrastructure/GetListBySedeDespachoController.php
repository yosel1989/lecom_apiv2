<?php


namespace Src\V2\Caja\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Caja\Application\GetListBySedeDespachoUseCase;
use Src\V2\Caja\Infrastructure\Repositories\EloquentCajaRepository;

final class GetListBySedeDespachoController
{
    private EloquentCajaRepository $repository;

    public function __construct(EloquentCajaRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): array
    {
        $idClient = $request->id;
        $idSede = $request->idSede;
        $getVehicleCollectionByClientUseCase = new GetListBySedeDespachoUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($idClient, $idSede);
    }

}
