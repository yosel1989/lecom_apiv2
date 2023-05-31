<?php


namespace Src\Admin\VehicleModel\Infrastructure;


use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Src\Admin\VehicleModel\Application\CreateVehicleModelUseCase;
use Src\Admin\VehicleModel\Domain\VehicleModel;
use Src\Admin\VehicleModel\Infrastructure\Repositories\EloquentVehicleModelRepository;

final class CreateVehicleModelController
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
        $id = Uuid::uuid4();
        $s_name = $request->input('name');
        $b_id = $request->input('brand');
        $createVehicleModelUseCase = new CreateVehicleModelUseCase($this->repository);
        return $createVehicleModelUseCase->__invoke( $id, $s_name, $b_id);
    }
}
