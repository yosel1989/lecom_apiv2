<?php


namespace Src\V2\EgresoTipo\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\EgresoTipo\Application\GetListByClienteUseCase;
use Src\V2\EgresoTipo\Domain\EgresoTipoShortList;
use Src\V2\EgresoTipo\Infrastructure\Repositories\EloquentEgresoTipoRepository;

final class GetListByClienteController
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
    public function __invoke( Request $request ): EgresoTipoShortList
    {
        $idClient = $request->id;
        $getVehicleCollectionByClientUseCase = new GetListByClienteUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($idClient);
    }

}
