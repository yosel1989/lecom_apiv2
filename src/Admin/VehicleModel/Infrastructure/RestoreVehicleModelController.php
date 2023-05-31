<?php


namespace Src\Admin\VehicleModel\Infrastructure;

use Illuminate\Http\Request;
use Src\Admin\VehicleModel\Application\RestoreVehicleModelUseCase;
use Src\Admin\VehicleModel\Infrastructure\Repositories\EloquentVehicleModelRepository;

final class RestoreVehicleModelController
{
    private $repository;

    public function __construct(EloquentVehicleModelRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request): void
    {
        $id = $request->id;
        $restoreVehicleModelUseCase = new RestoreVehicleModelUseCase($this->repository);
        $restoreVehicleModelUseCase->__invoke( $id );
    }
}
