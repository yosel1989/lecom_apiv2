<?php


namespace Src\Cold\ColdMachineModel\Infrastructure;

use Illuminate\Http\Request;
use Src\Cold\ColdMachineModel\Application\RestoreUseCase;
use Src\Cold\ColdMachineModel\Infrastructure\Repositories\EloquentColdMachineModelRepository;

final class RestoreController
{
    private $repository;

    public function __construct(EloquentColdMachineModelRepository $repository)
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
