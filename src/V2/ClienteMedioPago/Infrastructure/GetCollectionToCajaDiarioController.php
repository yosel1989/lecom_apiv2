<?php


namespace Src\V2\ClienteMedioPago\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\ClienteMedioPago\Application\GetCollectionToCajaDiarioUseCase;
use Src\V2\ClienteMedioPago\Domain\ClienteMedioPagoShortList;
use Src\V2\ClienteMedioPago\Infrastructure\Repositories\EloquentClienteMedioPagoRepository;

final class GetCollectionToCajaDiarioController
{
    private EloquentClienteMedioPagoRepository $repository;

    public function __construct(EloquentClienteMedioPagoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): ClienteMedioPagoShortList
    {
        $idCliente = $request->idCliente;
        $idCajaDiario = $request->idCajaDiario;
        $getVehicleCollectionByClientUseCase = new GetCollectionToCajaDiarioUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($idCliente, $idCajaDiario);
    }

}
