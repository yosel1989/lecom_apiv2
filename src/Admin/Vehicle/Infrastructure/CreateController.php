<?php


namespace Src\Admin\Vehicle\Infrastructure;


use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Src\Admin\Vehicle\Application\CreateUseCase;
use Src\Admin\Vehicle\Domain\Vehicle;
use Src\Admin\Vehicle\Infrastructure\Repositories\EloquentVehicleRepository;

final class CreateController
{
    private $repository;

    public function __construct(EloquentVehicleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request): ?Vehicle
    {
        $id = Uuid::uuid4();
        $v_client = $request->input('client');
        $v_plate = $request->input('plate');
        $v_unit = $request->input('unit');
        $v_category = $request->input('category');
        $v_brand = $request->input('brand');
        $v_model = $request->input('model');
        $v_class = $request->input('class');
        $createUseCase = new CreateUseCase($this->repository);
        return $createUseCase->__invoke(
            $id,
            $v_plate,
            $v_unit,
            $v_client,
            $v_category,
            $v_brand,
            $v_model,
            $v_class,
            null
        );
    }
}
