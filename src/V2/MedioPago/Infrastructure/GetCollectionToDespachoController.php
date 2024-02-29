<?php


namespace Src\V2\MedioPago\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\MedioPago\Application\GetCollectionToDespachoUseCase;
use Src\V2\MedioPago\Domain\MedioPagoShortList;
use Src\V2\MedioPago\Infrastructure\Repositories\EloquentMedioPagoRepository;

final class GetCollectionToDespachoController
{
    private EloquentMedioPagoRepository $repository;

    public function __construct(EloquentMedioPagoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): MedioPagoShortList
    {
        $idClient = $request->id;
        $getVehicleCollectionByClientUseCase = new GetCollectionToDespachoUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($idClient);
    }

}
