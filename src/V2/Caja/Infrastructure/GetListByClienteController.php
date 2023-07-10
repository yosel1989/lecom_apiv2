<?php


namespace Src\V2\Caja\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Caja\Application\GetListByClienteUseCase;
use Src\V2\Caja\Infrastructure\Repositories\EloquentCajaRepository;

final class GetListByClienteController
{
    private EloquentCajaRepository $repository;

    public function __construct(EloquentCajaRepository $repository)
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
