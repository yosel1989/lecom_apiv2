<?php


namespace Src\Admin\Vehicle\Infrastructure;


use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Src\Admin\Vehicle\Application\FindUseCase;
use Src\Admin\Vehicle\Domain\Vehicle;
use Src\Admin\Vehicle\Infrastructure\Repositories\EloquentVehicleRepository;

final class FindController
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
        $id = $request->id;
        $useCase = new FindUseCase($this->repository);
        return $useCase->__invoke(
            $id,
        );
    }
}
