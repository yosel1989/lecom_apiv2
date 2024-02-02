<?php


namespace Src\V2\TipoPersonal\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\TipoPersonal\Application\GetCollectionByClienteUseCase;
use Src\V2\TipoPersonal\Domain\TipoPersonalList;
use Src\V2\TipoPersonal\Infrastructure\Repositories\EloquentTipoPersonalRepository;

final class GetCollectionByClienteController
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
    public function __invoke( Request $request ): TipoPersonalList
    {
        $idClient = $request->id;
        $getVehicleCollectionByClientUseCase = new GetCollectionByClienteUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($idClient);
    }

}
