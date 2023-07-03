<?php


namespace Src\V2\Vehiculo\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Vehiculo\Application\ChangeStateUseCase;
use Src\V2\Vehiculo\Application\GetCollectionByClienteUseCase;
use Src\V2\Vehiculo\Infrastructure\Repositories\EloquentVehiculoRepository;

final class ChangeStateController
{
    private EloquentVehiculoRepository $repository;

    public function __construct(EloquentVehiculoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $idVehiculo = $request->idVehiculo;
        $idEstado = $request->input('idEstado');
        $useCase = new ChangeStateUseCase($this->repository);
        $useCase->__invoke(
            $idVehiculo,
            $idEstado,
            $user->getId()
        );
    }

}
