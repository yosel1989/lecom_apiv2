<?php


namespace Src\Admin\VehicleModel\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\VehicleModel\Application\UpdateVehicleModelUseCase;
use Src\Admin\VehicleModel\Domain\VehicleModel;
use Src\Admin\VehicleModel\Infrastructure\Repositories\EloquentVehicleModelRepository;

final class UpdateVehicleModelController
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
    public function __invoke(Request $request): ?VehicleModel
    {
        $id = $request->id;
        $s_name = $request->input('name');
        $b_id = $request->input('brand');
        $updateVehicleModelUseCase = new UpdateVehicleModelUseCase($this->repository);
        return $updateVehicleModelUseCase->__invoke( $id, $s_name, $b_id );
    }
}
