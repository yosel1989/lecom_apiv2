<?php


namespace Src\V2\EgresoTipo\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\EgresoTipo\Application\GetCollectionByClienteUseCase;
use Src\V2\EgresoTipo\Domain\EgresoTipoList;
use Src\V2\EgresoTipo\Infrastructure\Repositories\EloquentEgresoTipoRepository;

final class GetCollectionByClienteController
{
    private EloquentEgresoTipoRepository $repository;

    public function __construct(EloquentEgresoTipoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): EgresoTipoList
    {
        $idClient = $request->id;
        $getVehicleCollectionByClientUseCase = new GetCollectionByClienteUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($idClient);
    }

}
