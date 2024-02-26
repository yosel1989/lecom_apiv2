<?php


namespace Src\V2\IngresoTipo\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\IngresoTipo\Application\GetListByClienteUseCase;
use Src\V2\IngresoTipo\Domain\IngresoTipoShortList;
use Src\V2\IngresoTipo\Infrastructure\Repositories\EloquentIngresoTipoRepository;

final class GetListByClienteController
{
    private EloquentIngresoTipoRepository $repository;

    public function __construct(EloquentIngresoTipoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): IngresoTipoShortList
    {
        $idClient = $request->id;
        $getVehicleCollectionByClientUseCase = new GetListByClienteUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($idClient);
    }

}
