<?php


namespace Src\V2\Serie\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Serie\Application\GetCollectionByClienteUseCase;
use Src\V2\Serie\Infrastructure\Repositories\EloquentSerieRepository;

final class GetCollectionByClienteController
{
    private EloquentSerieRepository $repository;

    public function __construct(EloquentSerieRepository $repository)
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
