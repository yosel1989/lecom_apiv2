<?php


namespace Src\V2\ClienteMedioPago\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\ClienteMedioPago\Application\GetFlujoToCajaDiarioUseCase;
use Src\V2\ClienteMedioPago\Domain\ClienteMedioPagoFlujo;
use Src\V2\ClienteMedioPago\Infrastructure\Repositories\EloquentClienteMedioPagoRepository;

final class GetFlujoToCajaDiarioController
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
    public function __invoke( Request $request ): ClienteMedioPagoFlujo
    {
        $idCliente = $request->idCliente;
        $idCajaDiario = $request->idCajaDiario;
        $getVehicleCollectionByClientUseCase = new GetFlujoToCajaDiarioUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($idCliente, $idCajaDiario);
    }

}
