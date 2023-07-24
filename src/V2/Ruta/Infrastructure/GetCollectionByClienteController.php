<?php


namespace Src\V2\Ruta\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Ruta\Application\GetCollectionByClienteUseCase;
use Src\V2\Ruta\Infrastructure\Repositories\EloquentRutaRepository;

final class GetCollectionByClienteController
{
    private EloquentRutaRepository $repository;

    public function __construct(EloquentRutaRepository $repository)
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
