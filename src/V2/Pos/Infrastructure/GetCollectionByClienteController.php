<?php


namespace Src\V2\Pos\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Pos\Application\GetCollectionByClienteUseCase;
use Src\V2\Pos\Infrastructure\Repositories\EloquentPosRepository;

final class GetCollectionByClienteController
{
    private EloquentPosRepository $repository;

    public function __construct(EloquentPosRepository $repository)
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
        $getVehicleCollectionByClientUseCase = new GetCollectionByClienteUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($idClient);
    }

}
