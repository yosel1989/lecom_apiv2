<?php


namespace Src\Admin\VehicleModel\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\VehicleModel\Application\DeleteVehicleModelUseCase;
use Src\Admin\VehicleModel\Infrastructure\Repositories\EloquentVehicleModelRepository;

final class DeleteVehicleModelController
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
        $deleteVehicleModelUseCase = new DeleteVehicleModelUseCase($this->repository);
        $deleteVehicleModelUseCase->__invoke( $id );
    }
}
