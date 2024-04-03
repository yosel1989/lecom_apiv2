<?php


namespace Src\V2\MedioPago\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\MedioPago\Application\GetFlujoToCajaDiarioUseCase;
use Src\V2\MedioPago\Domain\MedioPagoFlujo;
use Src\V2\MedioPago\Infrastructure\Repositories\EloquentMedioPagoRepository;

final class GetFlujoToCajaDiarioController
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
    public function __invoke( Request $request ): MedioPagoFlujo
    {
        $idCliente = $request->idCliente;
        $idCajaDiario = $request->idCajaDiario;
        $getVehicleCollectionByClientUseCase = new GetFlujoToCajaDiarioUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($idCliente, $idCajaDiario);
    }

}
