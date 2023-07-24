<?php


namespace Src\V2\Paradero\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Paradero\Application\GetListByClienteUseCase;
use Src\V2\Paradero\Infrastructure\Repositories\EloquentParaderoRepository;

final class GetListByClienteController
{
    private EloquentParaderoRepository $repository;

    public function __construct(EloquentParaderoRepository $repository)
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
        $getVehicleCollectionByClientUseCase = new GetListByClienteUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($idClient);
    }

}
