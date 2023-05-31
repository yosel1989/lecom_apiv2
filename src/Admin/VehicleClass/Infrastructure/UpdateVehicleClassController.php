<?php


namespace Src\Admin\VehicleClass\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\VehicleClass\Application\UpdateVehicleClassUseCase;
use Src\Admin\VehicleClass\Domain\VehicleClass;
use Src\Admin\VehicleClass\Infrastructure\Repositories\EloquentVehicleClassRepository;

final class UpdateVehicleClassController
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
        $c_id = $request->id;
        $c_name = $request->input('name');
        $c_icon = $request->input('icon');
        $updateVehicleClassUseCase = new UpdateVehicleClassUseCase($this->repository);
        return $updateVehicleClassUseCase->__invoke( $c_id, $c_name, $c_icon );
    }
}
