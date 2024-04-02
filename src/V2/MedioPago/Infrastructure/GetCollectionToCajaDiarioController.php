<?php


namespace Src\V2\MedioPago\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\MedioPago\Application\GetCollectionToCajaDiarioUseCase;
use Src\V2\MedioPago\Domain\MedioPagoShortList;
use Src\V2\MedioPago\Infrastructure\Repositories\EloquentMedioPagoRepository;

final class GetCollectionToCajaDiarioController
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
        $idCliente = $request->idCliente;
        $idCajaDiario = $request->idCajaDiario;
        $getVehicleCollectionByClientUseCase = new GetCollectionToCajaDiarioUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($idCliente, $idCajaDiario);
    }

}
