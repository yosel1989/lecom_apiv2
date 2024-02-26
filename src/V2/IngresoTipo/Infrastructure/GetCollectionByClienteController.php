<?php


namespace Src\V2\IngresoTipo\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\IngresoTipo\Application\GetCollectionByClienteUseCase;
use Src\V2\IngresoTipo\Domain\IngresoTipoList;
use Src\V2\IngresoTipo\Infrastructure\Repositories\EloquentIngresoTipoRepository;

final class GetCollectionByClienteController
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
    public function __invoke( Request $request ): IngresoTipoList
    {
        $idClient = $request->id;
        $getVehicleCollectionByClientUseCase = new GetCollectionByClienteUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($idClient);
    }

}
