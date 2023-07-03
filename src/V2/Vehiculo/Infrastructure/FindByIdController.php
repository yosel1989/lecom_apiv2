<?php


namespace Src\V2\Vehiculo\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Vehiculo\Application\FindByIdUseCase;
use Src\V2\Vehiculo\Domain\Vehiculo;
use Src\V2\Vehiculo\Infrastructure\Repositories\EloquentVehiculoRepository;

final class FindByIdController
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
    public function __invoke( Request $request ): Vehiculo
    {
        $idVehiculo = $request->id;
        $useCase = new FindByIdUseCase($this->repository);
        return $useCase->__invoke($idVehiculo);
    }

}
