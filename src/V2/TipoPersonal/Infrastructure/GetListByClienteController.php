<?php


namespace Src\V2\TipoPersonal\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\TipoPersonal\Application\GetListByClienteUseCase;
use Src\V2\TipoPersonal\Domain\TipoPersonalShortList;
use Src\V2\TipoPersonal\Infrastructure\Repositories\EloquentTipoPersonalRepository;

final class GetListByClienteController
{
    private EloquentTipoPersonalRepository $repository;

    public function __construct(EloquentTipoPersonalRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): TipoPersonalShortList
    {
        $idClient = $request->id;
        $getVehicleCollectionByClientUseCase = new GetListByClienteUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($idClient);
    }

}
