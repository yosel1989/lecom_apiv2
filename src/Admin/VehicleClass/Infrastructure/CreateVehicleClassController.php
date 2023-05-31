<?php


namespace Src\Admin\VehicleClass\Infrastructure;


use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Src\Admin\VehicleClass\Application\CreateVehicleClassUseCase;
use Src\Admin\VehicleClass\Domain\VehicleClass;
use Src\Admin\VehicleClass\Infrastructure\Repositories\EloquentVehicleClassRepository;

final class CreateVehicleClassController
{
    private $repository;

    public function __construct(EloquentVehicleClassRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request): ?VehicleClass
    {
        $c_id = Uuid::uuid4();
        $c_name = $request->input('name');
        $c_icon = $request->input('icon');
        $createVehicleClassUseCase = new CreateVehicleClassUseCase($this->repository);
        return $createVehicleClassUseCase->__invoke( $c_id, $c_name, $c_icon);
    }
}
