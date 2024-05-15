<?php


namespace Src\V2\MedioPago\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\MedioPago\Application\GetCollectionByClienteUseCase;
use Src\V2\MedioPago\Domain\MedioPagoShortList;
use Src\V2\MedioPago\Infrastructure\Repositories\EloquentMedioPagoRepository;

final class GetCollectionByClienteController
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
        $idCliente = $request->id;
        $getVehicleCollectionByClientUseCase = new GetCollectionByClienteUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($idCliente);
    }

}
