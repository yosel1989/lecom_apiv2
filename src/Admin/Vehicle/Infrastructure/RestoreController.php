<?php


namespace Src\Admin\Vehicle\Infrastructure;

use Illuminate\Http\Request;
use Src\Admin\Vehicle\Application\RestoreUseCase;
use Src\Admin\Vehicle\Infrastructure\Repositories\EloquentVehicleRepository;

final class RestoreController
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
    public function __invoke(Request $request): void
    {
        $id = $request->id;
        $restoreUseCase = new RestoreUseCase($this->repository);
        $restoreUseCase->__invoke( $id );
    }
}
