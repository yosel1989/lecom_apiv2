<?php


namespace Src\V2\Ruta\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Ruta\Application\GetListByClienteUseCase;
use Src\V2\Ruta\Infrastructure\Repositories\EloquentRutaRepository;

final class GetListByClienteController
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
        $getVehicleCollectionByClientUseCase = new GetListByClienteUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($idClient);
    }

}
