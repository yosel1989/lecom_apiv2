<?php


namespace Src\Admin\VehicleBrand\Infrastructure;


use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Src\Admin\VehicleBrand\Application\CreateVehicleBrandUseCase;
use Src\Admin\VehicleBrand\Domain\VehicleBrand;
use Src\Admin\VehicleBrand\Infrastructure\Repositories\EloquentVehicleBrandRepository;

final class CreateVehicleBrandController
{
    private $repository;

    public function __construct(EloquentVehicleBrandRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request): ?VehicleBrand
    {
        $id = Uuid::uuid4();
        $b_name = $request->input('name');
        $createVehicleBrandUseCase = new CreateVehicleBrandUseCase($this->repository);
        return $createVehicleBrandUseCase->__invoke( $id, $b_name );
    }
}
