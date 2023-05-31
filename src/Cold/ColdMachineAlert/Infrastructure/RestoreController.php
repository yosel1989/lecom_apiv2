<?php


namespace Src\Cold\ColdMachineAlert\Infrastructure;

use Illuminate\Http\Request;
use Src\Cold\ColdMachineAlert\Application\RestoreUseCase;
use Src\Cold\ColdMachineAlert\Infrastructure\Repositories\EloquentColdMachineAlertRepository;

final class RestoreController
{
    private $repository;

    public function __construct(EloquentColdMachineAlertRepository $repository)
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
